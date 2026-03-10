<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\JobApplication;
use App\Models\Message;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display messages/conversations page
     */
    public function index(Request $request)
    {
        $recruiter = $this->currentRecruiter();
        $userId = Auth::id();
        
        // Get all conversations for this user
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->with(['userOne', 'userTwo', 'lastMessage', 'jobApplication.jobPost.company'])
            ->orderBy('last_message_at', 'desc')
            ->get();
        
        // Get selected conversation ID from query parameter
        $selectedConversationId = $request->query('conversation_id');
        
        // Get selected conversation with messages
        $selectedConversation = null;
        $messages = collect();
        
        if ($selectedConversationId) {
            $selectedConversation = Conversation::with([
                'userOne', 
                'userTwo', 
                'jobApplication.jobPost.company',
                'messages.sender'
            ])
            ->where('id', $selectedConversationId)
            ->where(function($query) use ($userId) {
                $query->where('user_one_id', $userId)
                      ->orWhere('user_two_id', $userId);
            })
            ->first();
            
            if ($selectedConversation) {
                $messages = $selectedConversation->messages;
                
                // Mark messages as seen
                $selectedConversation->messages()
                    ->where('sender_id', '!=', $userId)
                    ->where('is_seen', false)
                    ->update(['is_seen' => true]);
            }
        } elseif ($conversations->isNotEmpty()) {
            // Auto-select first conversation if none selected
            $selectedConversation = Conversation::with([
                'userOne', 
                'userTwo', 
                'jobApplication.jobPost.company',
                'messages.sender'
            ])
            ->where('id', $conversations->first()->id)
            ->first();
            
            if ($selectedConversation) {
                $messages = $selectedConversation->messages;
                $selectedConversationId = $selectedConversation->id;
                
                // Mark messages as seen
                $selectedConversation->messages()
                    ->where('sender_id', '!=', $userId)
                    ->where('is_seen', false)
                    ->update(['is_seen' => true]);
            }
        }
        
        return view('recruiter.messages.index', compact('conversations', 'selectedConversation', 'messages', 'selectedConversationId'));
    }

    /**
     * Send a message in a conversation
     */
    public function sendMessage(Request $request, $conversationId)
    {
        try {
            $userId = Auth::id();
            
            // Verify user belongs to this conversation
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            // Validate message
            $validated = $request->validate([
                'message' => 'required|string|max:1000',
            ]);
            
            // Create message
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $userId,
                'message' => $validated['message'],
                'type' => 'text',
                'is_seen' => false,
            ]);
            
            // Update conversation's last message
            $conversation->update([
                'last_message_id' => $message->id,
                'last_message_at' => now(),
            ]);
            
            return redirect()->route('recruiter.messages', ['conversation_id' => $conversationId])
                ->with('success', 'Message sent successfully');
                
        } catch (\Exception $e) {
            Log::error('Send message error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send message');
        }
    }

    /**
     * Send a message via API (for real-time chat)
     */
    public function sendMessageApi(Request $request, $conversationId)
    {
        try {
            $userId = Auth::id();
            
            // Verify user belongs to this conversation
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            // Validate based on message type
            $validated = $request->validate([
                'message' => 'required_if:type,text|nullable|string|max:1000',
                'type' => 'required|in:text,request_contact,request_email,request_resume',
            ]);
            
            $messageType = $validated['type'] ?? 'text';
            $messageText = $validated['message'] ?? '';
            
            // Set default message for request types
            if ($messageType === 'request_contact') {
                $messageText = 'I would like to request your contact number.';
            } elseif ($messageType === 'request_email') {
                $messageText = 'I would like to request your email address.';
            } elseif ($messageType === 'request_resume') {
                $messageText = 'I would like to request your resume/CV.';
            }
            
            // Create message
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $userId,
                'message' => $messageText,
                'type' => $messageType,
                'request_status' => ($messageType !== 'text') ? 'pending' : null,
                'is_seen' => false,
            ]);
            
            // Load sender relationship
            $message->load('sender');
            
            // Update conversation's last message
            $conversation->update([
                'last_message_id' => $message->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
                
        } catch (\Exception $e) {
            Log::error('Send message API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to send message'
            ], 500);
        }
    }

    /**
     * Start or get conversation with a candidate from job application
     */
    public function startOrGetConversation($applicationId)
    {
        try {
            $recruiter = $this->currentRecruiter();
            $userId = Auth::id();
            
            // Get the application with candidate
            $application = JobApplication::with(['candidate.user', 'jobPost.company'])
                ->where('id', $applicationId)
                ->whereHas('jobPost', function($query) use ($recruiter) {
                    $query->where('recruiter_id', $recruiter->id);
                })
                ->firstOrFail();

            // Check if candidate user exists
            if (!$application->candidate || !$application->candidate->user_id) {
                return redirect()->back()->with('error', 'Unable to start conversation with this candidate');
            }

            $candidateUserId = $application->candidate->user_id;

            // Ensure user_one_id is always the smaller ID for uniqueness
            $userOneId = min($userId, $candidateUserId);
            $userTwoId = max($userId, $candidateUserId);

            // Check if conversation already exists
            $conversation = Conversation::where('user_one_id', $userOneId)
                ->where('user_two_id', $userTwoId)
                ->first();

            if (!$conversation) {
                // Create new conversation
                $conversation = Conversation::create([
                    'user_one_id' => $userOneId,
                    'user_two_id' => $userTwoId,
                    'job_application_id' => $application->id,
                ]);

                // Send automatic greeting message from recruiter
                $messageText = "Hello! Thank you for applying for the position of {$application->jobPost->title}. We have received your application and will review it shortly.";

                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $userId,
                    'message' => $messageText,
                    'type' => 'text',
                    'is_seen' => false,
                ]);

                // Update conversation's last message
                $conversation->update([
                    'last_message_id' => $message->id,
                    'last_message_at' => now(),
                ]);
            }

            // Redirect to messages page with conversation ID
            return redirect()->route('recruiter.messages', ['conversation_id' => $conversation->id])
                ->with('success', 'Conversation opened');

        } catch (\Exception $e) {
            Log::error('Start conversation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to start conversation');
        }
    }

    /**
     * Get unread messages count for the authenticated recruiter
     */
    public function getUnreadCount()
    {
        $userId = Auth::id();
        
        $unreadCount = Message::whereHas('conversation', function($query) use ($userId) {
            $query->where('user_one_id', $userId)
                  ->orWhere('user_two_id', $userId);
        })
        ->where('sender_id', '!=', $userId)
        ->where('is_seen', false)
        ->count();
        
        return response()->json(['unread_count' => $unreadCount]);
    }

    /**
     * Mark conversation messages as read
     */
    public function markAsRead($conversationId)
    {
        try {
            $userId = Auth::id();
            
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            $conversation->messages()
                ->where('sender_id', '!=', $userId)
                ->where('is_seen', false)
                ->update(['is_seen' => true]);
            
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            Log::error('Mark as read error: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    /**
     * Delete a conversation
     */
    public function deleteConversation($conversationId)
    {
        try {
            $userId = Auth::id();
            
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            // Delete all messages in the conversation
            $conversation->messages()->delete();
            
            // Delete the conversation
            $conversation->delete();
            
            return redirect()->route('recruiter.messages')
                ->with('success', 'Conversation deleted successfully');
            
        } catch (\Exception $e) {
            Log::error('Delete conversation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete conversation');
        }
    }

    /**
     * Get current recruiter
     */
    protected function currentRecruiter(): Recruiter
    {
        $recruiter = Recruiter::where('user_id', Auth::id())->first();
        
        if (!$recruiter) {
            abort(403, 'You need to complete your recruiter profile first.');
        }
        
        return $recruiter;
    }

    /**
     * Respond to a candidate request (contact, email, or company location)
     */
    public function respondToRequest(Request $request, $messageId)
    {
        try {
            $userId = Auth::id();
            $recruiter = $this->currentRecruiter();
            
            // Get the original request message
            $requestMessage = Message::with('conversation.jobApplication.jobPost.company')
                ->where('id', $messageId)
                ->whereHas('conversation', function($query) use ($userId) {
                    $query->where(function($q) use ($userId) {
                        $q->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                    });
                })
                ->firstOrFail();
            
            // Validate based on request type
            $rules = [];
            if ($requestMessage->type === 'request_contact') {
                $rules['phone'] = 'required|string|max:20';
            } elseif ($requestMessage->type === 'request_email') {
                $rules['email'] = 'required|email|max:255';
            } elseif ($requestMessage->type === 'request_location') {
                $rules['location'] = 'required|string|max:500';
            }
            
            $validated = $request->validate($rules);
            
            // Update the request message status
            $requestMessage->update(['request_status' => 'approved']);
            
            // Create response message
            $responseData = [
                'conversation_id' => $requestMessage->conversation_id,
                'sender_id' => $userId,
                'type' => $requestMessage->type . '_response',
                'is_seen' => false,
            ];
            
            if ($requestMessage->type === 'request_contact') {
                $responseData['phone'] = $validated['phone'];
                $responseData['message'] = 'Here is my contact number: ' . $validated['phone'];
            } elseif ($requestMessage->type === 'request_email') {
                $responseData['email'] = $validated['email'];
                $responseData['message'] = 'Here is my email: ' . $validated['email'];
            } elseif ($requestMessage->type === 'request_location') {
                // Get company location from job post if available
                $companyLocation = $validated['location'];
                $responseData['message'] = 'Company Location: ' . $companyLocation;
            }
            
            $responseMessage = Message::create($responseData);
            $responseMessage->load('sender');
            
            // Update conversation's last message
            $requestMessage->conversation->update([
                'last_message_id' => $responseMessage->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $responseMessage,
                'requestMessage' => $requestMessage
            ]);
                
        } catch (\Exception $e) {
            Log::error('Respond to request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to respond to request'
            ], 500);
        }
    }

    /**
     * Decline a candidate request
     */
    public function declineRequest(Request $request, $messageId)
    {
        try {
            $userId = Auth::id();
            
            // Get the original request message
            $requestMessage = Message::with('conversation')
                ->where('id', $messageId)
                ->whereHas('conversation', function($query) use ($userId) {
                    $query->where(function($q) use ($userId) {
                        $q->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                    });
                })
                ->firstOrFail();
            
            // Update the request message status
            $requestMessage->update(['request_status' => 'declined']);
            
            // Create decline message
            $declineMessage = Message::create([
                'conversation_id' => $requestMessage->conversation_id,
                'sender_id' => $userId,
                'message' => 'I prefer not to share this information at this time.',
                'type' => 'text',
                'is_seen' => false,
            ]);
            
            $declineMessage->load('sender');
            
            // Update conversation's last message
            $requestMessage->conversation->update([
                'last_message_id' => $declineMessage->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $declineMessage,
                'requestMessage' => $requestMessage
            ]);
                
        } catch (\Exception $e) {
            Log::error('Decline request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to decline request'
            ], 500);
        }
    }
}
