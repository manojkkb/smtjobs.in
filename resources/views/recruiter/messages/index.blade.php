@extends('recruiter.layouts.app')

@section('title', 'Messages · SMT Recruiter')

@section('content')
    <div class="p-4 sm:p-6">
        <div class="mb-4 sm:mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Messages</h1>
            <p class="text-slate-600 mt-1 sm:mt-2 text-sm sm:text-base">Communication with candidates</p>
        </div>

        @if($conversations->isEmpty())
            <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-8 sm:p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-slate-300 mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-1 sm:mb-2">No messages yet</h3>
                <p class="text-slate-600 text-sm sm:text-base">Messages from candidates will appear here</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                {{-- Conversations List --}}
                <div class="lg:col-span-1">
                    <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white overflow-hidden">
                        <div class="bg-slate-50 border-b border-slate-200 px-4 py-3">
                            <h2 class="text-base sm:text-lg font-semibold text-slate-900">Conversations</h2>
                        </div>
                        <div class="divide-y divide-slate-200 max-h-[60vh] overflow-y-auto">
                            @foreach($conversations as $conversation)
                                @php
                                    $otherUser = $conversation->getOtherUser(auth()->user()->id);
                                    $isSelected = $selectedConversationId == $conversation->id;
                                    $unreadCount = $conversation->messages()->where('sender_id', '!=', auth()->user()->id)->where('is_seen', false)->count();
                                @endphp
                                <a href="{{ route('recruiter.messages', ['conversation_id' => $conversation->id]) }}" 
                                   class="block px-4 py-3 hover:bg-slate-50 transition {{ $isSelected ? 'bg-slate-100' : '' }}">
                                    <div class="flex items-start gap-3">
                                        <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                                            <span class="text-sm sm:text-base font-semibold text-slate-700">
                                                {{ substr($otherUser->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-2">
                                                <h3 class="text-sm sm:text-base font-semibold text-slate-900 truncate">
                                                    {{ $otherUser->name ?? 'User' }}
                                                </h3>
                                                @if($unreadCount > 0)
                                                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-slate-900 text-white text-xs font-bold">
                                                        {{ $unreadCount }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if($conversation->jobApplication && $conversation->jobApplication->jobPost)
                                                <p class="text-xs text-slate-500 truncate">
                                                    {{ $conversation->jobApplication->jobPost->title }}
                                                </p>
                                            @endif
                                            @if($conversation->lastMessage)
                                                <p class="text-xs sm:text-sm text-slate-600 truncate mt-1">
                                                    {{ Str::limit($conversation->lastMessage->message, 40) }}
                                                </p>
                                            @endif
                                            <p class="text-xs text-slate-400 mt-1">
                                                {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : '' }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Messages Area --}}
                <div class="lg:col-span-2">
                    @if($selectedConversation)
                        <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white flex flex-col h-[70vh]">
                            {{-- Conversation Header --}}
                            <div class="bg-slate-50 border-b border-slate-200 px-4 py-3 flex-shrink-0">
                                @php
                                    $otherUser = $selectedConversation->getOtherUser(auth()->user()->id);
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm sm:text-base font-semibold text-slate-700">
                                            {{ substr($otherUser->name ?? 'U', 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h2 class="text-base sm:text-lg font-semibold text-slate-900 truncate">
                                            {{ $otherUser->name ?? 'User' }}
                                        </h2>
                                        @if($selectedConversation->jobApplication && $selectedConversation->jobApplication->jobPost)
                                            <p class="text-xs sm:text-sm text-slate-600 truncate">
                                                {{ $selectedConversation->jobApplication->jobPost->title }} at {{ $selectedConversation->jobApplication->jobPost->company->name }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Messages List --}}
                            <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messagesContainer">
                                @forelse($messages as $message)
                                    @php
                                        $isSender = $message->sender_id == auth()->user()->id;
                                    @endphp
                                    <div class="flex {{ $isSender ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                                        <div class="max-w-[75%] sm:max-w-[70%]">
                                            @if($message->type === 'text')
                                                <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 {{ $isSender ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-900' }}">
                                                    <p class="text-sm sm:text-base break-words">{{ $message->message }}</p>
                                                </div>
                                            @elseif(str_starts_with($message->type, 'request_'))
                                                <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 {{ $isSender ? 'bg-blue-50 border border-blue-200' : 'bg-purple-50 border border-purple-200' }}">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="text-lg">
                                                            @if($message->type === 'request_contact') 📞
                                                            @elseif($message->type === 'request_email') 📧
                                                            @elseif($message->type === 'request_resume') 📄
                                                            @endif
                                                        </span>
                                                        @if($message->request_status === 'pending')
                                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full">Pending</span>
                                                        @elseif($message->request_status === 'approved')
                                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Approved</span>
                                                        @elseif($message->request_status === 'declined')
                                                            <span class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Declined</span>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm sm:text-base break-words text-slate-900">{{ $message->message }}</p>
                                                </div>
                                            @elseif(str_contains($message->type, '_response'))
                                                <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 {{ $isSender ? 'bg-slate-900 text-white' : 'bg-green-50 border border-green-200 text-slate-900' }}">
                                                    <p class="text-sm sm:text-base break-words font-semibold">✓ {{ $message->message }}</p>
                                                    @if($message->phone)
                                                        <p class="text-sm mt-1">Phone: {{ $message->phone }}</p>
                                                    @endif
                                                    @if($message->email)
                                                        <p class="text-sm mt-1">Email: {{ $message->email }}</p>
                                                    @endif
                                                    @if($message->cv_file)
                                                        <a href="{{ asset('storage/' . $message->cv_file) }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 block">📎 Download Resume</a>
                                                    @endif
                                                </div>
                                            @endif
                                            <p class="text-xs text-slate-400 mt-1 {{ $isSender ? 'text-right' : 'text-left' }}">
                                                {{ $message->created_at->format('M d, Y · h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-slate-500 text-sm py-8">
                                        No messages yet. Start the conversation!
                                    </div>
                                @endforelse
                            </div>

                            {{-- Message Input --}}
                            <div class="border-t border-slate-200 p-4 flex-shrink-0">
                                {{-- Request Buttons --}}
                                <div class="flex gap-2 mb-3">
                                    <button type="button" onclick="sendRequest('request_contact')" class="text-xs sm:text-sm px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition border border-blue-200 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact
                                    </button>
                                    <button type="button" onclick="sendRequest('request_email')" class="text-xs sm:text-sm px-3 py-1.5 rounded-lg bg-green-50 text-green-700 hover:bg-green-100 transition border border-green-200 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email
                                    </button>
                                    <button type="button" onclick="sendRequest('request_resume')" class="text-xs sm:text-sm px-3 py-1.5 rounded-lg bg-purple-50 text-purple-700 hover:bg-purple-100 transition border border-purple-200 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Resume
                                    </button>
                                </div>

                                <form id="messageForm" class="flex gap-2">
                                    @csrf
                                    <input type="text" 
                                           id="messageInput"
                                           name="message" 
                                           placeholder="Type your message..." 
                                           required
                                           autocomplete="off"
                                           class="flex-1 rounded-lg sm:rounded-xl border border-slate-300 px-3 sm:px-4 py-2 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-transparent">
                                    <button type="submit" class="rounded-lg sm:rounded-xl bg-slate-900 px-4 sm:px-6 py-2 text-sm sm:text-base font-semibold text-white transition hover:bg-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </button>
                                </form>
                                <div id="typingIndicator" class="text-xs text-slate-500 mt-2 hidden"></div>
                            </div>
                        </div>

                        {{-- Socket.IO Real-time Chat Script --}}
                        <script type="module">
                            import { io } from 'https://cdn.socket.io/4.7.2/socket.io.esm.min.js';

                            const userId = {{ auth()->user()->id }};
                            const userName = "{{ auth()->user()->name }}";
                            const userType = "recruiter";
                            const conversationId = {{ $selectedConversation->id }};
                            
                            // Connect to Socket.IO server
                            const socket = io('http://localhost:3000', {
                                auth: {
                                    userId: userId,
                                    userType: userType
                                }
                            });

                            socket.on('connect', () => {
                                console.log('Socket.IO connected');
                                // Join this conversation room
                                socket.emit('join-conversations', [conversationId]);
                            });

                            socket.on('connect_error', (error) => {
                                console.error('Socket.IO connection error:', error.message);
                            });

                            // Listen for new messages
                            socket.on('new-message', (data) => {
                                if (data.conversationId == conversationId) {
                                    const message = data.message;
                                    // Don't add the message if we're the sender (already added)
                                    if (message.sender_id != userId) {
                                        addMessageToUI(message);
                                        scrollToBottom();
                                    }
                                }
                            });

                            // Listen for typing indicators
                            socket.on('user-typing', (data) => {
                                if (data.conversationId == conversationId && data.userId != userId) {
                                    const indicator = document.getElementById('typingIndicator');
                                    indicator.textContent = `${data.userName} is typing...`;
                                    indicator.classList.remove('hidden');
                                }
                            });

                            socket.on('user-stop-typing', (data) => {
                                if (data.conversationId == conversationId && data.userId != userId) {
                                    const indicator = document.getElementById('typingIndicator');
                                    indicator.classList.add('hidden');
                                }
                            });

                            // Handle form submission
                            const form = document.getElementById('messageForm');
                            const input = document.getElementById('messageInput');

                            form.addEventListener('submit', async (e) => {
                                e.preventDefault();
                                const messageText = input.value.trim();
                                
                                if (!messageText) return;

                                // Disable input while sending
                                input.disabled = true;

                                try {
                                    // Send to Laravel API
                                    const response = await fetch('{{ route("recruiter.message.send.api", $selectedConversation->id) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ 
                                            message: messageText,
                                            type: 'text'
                                        })
                                    });

                                    const result = await response.json();
                                    
                                    if (result.success) {
                                        // Add message to UI
                                        addMessageToUI(result.message, true);
                                        
                                        // Emit to Socket.IO
                                        socket.emit('send-message', {
                                            conversationId: conversationId,
                                            message: result.message,
                                            senderId: userId,
                                            senderName: userName,
                                            senderAvatar: null
                                        });

                                        // Clear input and scroll
                                        input.value = '';
                                        scrollToBottom();
                                        socket.emit('stop-typing', { conversationId });
                                    } else {
                                        alert('Failed to send message');
                                    }
                                } catch (error) {
                                    console.error('Error sending message:', error);
                                    alert('Failed to send message');
                                } finally {
                                    input.disabled = false;
                                    input.focus();
                                }
                            });

                            // Send request function
                            window.sendRequest = async function(requestType) {
                                try {
                                    const response = await fetch('{{ route("recruiter.message.send.api", $selectedConversation->id) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ 
                                            message: '',
                                            type: requestType
                                        })
                                    });

                                    const result = await response.json();
                                    
                                    if (result.success) {
                                        // Add message to UI
                                        addMessageToUI(result.message, true);
                                        
                                        // Emit to Socket.IO
                                        socket.emit('send-message', {
                                            conversationId: conversationId,
                                            message: result.message,
                                            senderId: userId,
                                            senderName: userName,
                                            senderAvatar: null
                                        });

                                        scrollToBottom();
                                    } else {
                                        alert('Failed to send request');
                                    }
                                } catch (error) {
                                    console.error('Error sending request:', error);
                                    alert('Failed to send request');
                                }
                            };

                            // Typing indicator
                            let typingTimeout;
                            input.addEventListener('input', () => {
                                socket.emit('typing', { conversationId, userName });
                                
                                clearTimeout(typingTimeout);
                                typingTimeout = setTimeout(() => {
                                    socket.emit('stop-typing', { conversationId });
                                }, 1000);
                            });

                            // Add message to UI
                            function addMessageToUI(message, isSender = false) {
                                const container = document.getElementById('messagesContainer');
                                
                                // Check if it's actually our message
                                if (message.sender_id == userId) {
                                    isSender = true;
                                }
                                
                                const messageDiv = document.createElement('div');
                                messageDiv.className = `flex ${isSender ? 'justify-end' : 'justify-start'}`;
                                messageDiv.setAttribute('data-message-id', message.id);
                                
                                const date = new Date(message.created_at);
                                const formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + 
                                                    ' · ' + date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                                
                                let messageContent = '';
                                
                                // Handle different message types
                                if (message.type === 'text') {
                                    messageContent = `
                                        <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 ${isSender ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-900'}">
                                            <p class="text-sm sm:text-base break-words">${escapeHtml(message.message)}</p>
                                        </div>
                                    `;
                                } else if (message.type.startsWith('request_')) {
                                    const requestIcon = message.type === 'request_contact' ? '📞' : 
                                                       message.type === 'request_email' ? '📧' : 
                                                       message.type === 'request_location' ? '📍' : '📄';
                                    const statusBadge = message.request_status === 'pending' ? '<span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full">Pending</span>' :
                                                       message.request_status === 'approved' ? '<span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Approved</span>' :
                                                       message.request_status === 'declined' ? '<span class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Declined</span>' : '';
                                    
                                    let actionButtons = '';
                                    if (message.request_status === 'pending' && !isSender) {
                                        const actionType = message.type === 'request_contact' ? 'showContactForm' :
                                                          message.type === 'request_email' ? 'showEmailForm' : 'showLocationForm';
                                        const actionLabel = message.type === 'request_contact' ? 'Share Contact' :
                                                           message.type === 'request_email' ? 'Share Email' : 'Share Location';
                                        actionButtons = `
                                            <div class="flex gap-2 request-actions-${message.id} mt-3">
                                                <button onclick="${actionType}(${message.id})" class="text-xs px-3 py-1.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">${actionLabel}</button>
                                                <button onclick="declineRequest(${message.id})" class="text-xs px-3 py-1.5 rounded-lg bg-slate-200 text-slate-700 hover:bg-slate-300 transition">Decline</button>
                                            </div>
                                        `;
                                    }
                                    
                                    messageContent = `
                                        <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 ${isSender ? 'bg-blue-50 border border-blue-200' : 'bg-purple-50 border border-purple-200'}">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-lg">${requestIcon}</span>
                                                ${statusBadge}
                                            </div>
                                            <p class="text-sm sm:text-base break-words text-slate-900">${escapeHtml(message.message)}</p>
                                            ${actionButtons}
                                        </div>
                                    `;
                                } else if (message.type.includes('_response')) {
                                    messageContent = `
                                        <div class="rounded-xl sm:rounded-2xl px-3 sm:px-4 py-2 sm:py-3 ${isSender ? 'bg-slate-900 text-white' : 'bg-green-50 border border-green-200 text-slate-900'}">
                                            <p class="text-sm sm:text-base break-words font-semibold">✓ ${escapeHtml(message.message)}</p>
                                            ${message.phone ? `<p class="text-sm mt-1">Phone: ${escapeHtml(message.phone)}</p>` : ''}
                                            ${message.email ? `<p class="text-sm mt-1">Email: ${escapeHtml(message.email)}</p>` : ''}
                                            ${message.location ? `<p class="text-sm mt-1">Location: ${escapeHtml(message.location)}</p>` : ''}
                                            ${message.cv_file ? `<a href="/storage/${message.cv_file}" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 block">📎 Download Resume</a>` : ''}
                                        </div>
                                    `;
                                }
                                
                                messageDiv.innerHTML = `
                                    <div class="max-w-[75%] sm:max-w-[70%]">
                                        ${messageContent}
                                        <p class="text-xs text-slate-400 mt-1 ${isSender ? 'text-right' : 'text-left'}">
                                            ${formattedDate}
                                        </p>
                                    </div>
                                `;
                                
                                container.appendChild(messageDiv);
                            }

                            // Scroll to bottom
                            function scrollToBottom() {
                                const container = document.getElementById('messagesContainer');
                                container.scrollTop = container.scrollHeight;
                            }

                            // HTML escape helper
                            function escapeHtml(text) {
                                const map = {
                                    '&': '&amp;',
                                    '<': '&lt;',
                                    '>': '&gt;',
                                    '"': '&quot;',
                                    "'": '&#039;'
                                };
                                return text.replace(/[&<>"']/g, m => map[m]);
                            }

                            // Show contact form
                            window.showContactForm = function(messageId) {
                                const phone = prompt('Enter your contact number:');
                                if (phone && phone.trim()) {
                                    respondToRequest(messageId, { phone: phone.trim() });
                                }
                            };

                            // Show email form
                            window.showEmailForm = function(messageId) {
                                const email = prompt('Enter your email address:');
                                if (email && email.trim()) {
                                    respondToRequest(messageId, { email: email.trim() });
                                }
                            };

                            // Show location form
                            window.showLocationForm = function(messageId) {
                                const location = prompt('Enter your company location/address:');
                                if (location && location.trim()) {
                                    respondToRequest(messageId, { location: location.trim() });
                                }
                            };

                            // Respond to request
                            async function respondToRequest(messageId, data) {
                                try {
                                    const response = await fetch('{{ route("recruiter.request.respond", ":id") }}'.replace(':id', messageId), {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify(data)
                                    });

                                    const result = await response.json();
                                    
                                    if (result.success) {
                                        // Update the request message status in UI
                                        const requestEl = document.querySelector(`.request-actions-${messageId}`);
                                        if (requestEl) {
                                            requestEl.remove();
                                        }

                                        // Add response message to UI
                                        addMessageToUI(result.message, true);
                                        
                                        // Emit to Socket.IO
                                        socket.emit('send-message', {
                                            conversationId: conversationId,
                                            message: result.message,
                                            senderId: userId,
                                            senderName: userName,
                                            senderAvatar: null
                                        });

                                        scrollToBottom();
                                    } else {
                                        alert('Failed to respond to request');
                                    }
                                } catch (error) {
                                    console.error('Error responding to request:', error);
                                    alert('Failed to respond to request');
                                }
                            }

                            // Decline request
                            window.declineRequest = async function(messageId) {
                                if (!confirm('Are you sure you want to decline this request?')) {
                                    return;
                                }

                                try {
                                    const response = await fetch('{{ route("recruiter.request.decline", ":id") }}'.replace(':id', messageId), {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    });

                                    const result = await response.json();
                                    
                                    if (result.success) {
                                        // Update the request message status in UI
                                        const requestEl = document.querySelector(`.request-actions-${messageId}`);
                                        if (requestEl) {
                                            requestEl.remove();
                                        }

                                        // Add decline message to UI
                                        addMessageToUI(result.message, true);
                                        
                                        // Emit to Socket.IO
                                        socket.emit('send-message', {
                                            conversationId: conversationId,
                                            message: result.message,
                                            senderId: userId,
                                            senderName: userName,
                                            senderAvatar: null
                                        });

                                        scrollToBottom();
                                    } else {
                                        alert('Failed to decline request');
                                    }
                                } catch (error) {
                                    console.error('Error declining request:', error);
                                    alert('Failed to decline request');
                                }
                            };

                            // Initial scroll to bottom
                            document.addEventListener('DOMContentLoaded', () => {
                                scrollToBottom();
                            });
                        </script>
                    @else
                        <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-8 sm:p-12 text-center h-[70vh] flex items-center justify-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-slate-300 mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-1 sm:mb-2">Select a conversation</h3>
                                <p class="text-slate-600 text-sm sm:text-base">Choose a conversation from the list to view messages</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
