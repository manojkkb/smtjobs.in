@extends('candidate.layouts.app')

@section('title', 'Messages · SMTJobs')

{{-- Hide mobile bottom nav when viewing a chat --}}
@if(!empty($hasExplicitSelection) && $selectedConversation)
    @section('hideBottomNav', true)
@endif

@section('content')
    {{-- 
        Mobile: full-screen chat app layout (show list OR chat, not both)
        Desktop (md+): side-by-side layout with conversation list + chat area
        Bottom nav ~56px on mobile, top nav ~56px on desktop
    --}}
    <style>
        .msg-container { height: calc(100dvh - 56px); } /* mobile: full height minus bottom nav */
        .msg-container-chat { height: 100dvh; } /* mobile chat: full height, no bottom nav */
        @media (min-width: 768px) { .msg-container, .msg-container-chat { height: calc(100dvh - 56px); } } /* desktop: minus top nav */
    </style>

    @if($conversations->isEmpty())
        <div class="mx-auto max-w-7xl px-3 sm:px-4 md:px-6 lg:px-8 pt-4 md:pt-20 lg:pt-24 pb-20 md:pb-8">
            <div class="mb-4 sm:mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Messages</h1>
                <p class="text-slate-600 mt-1 sm:mt-2 text-sm sm:text-base">Communication with recruiters and employers</p>
            </div>
            <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-8 sm:p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-slate-300 mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-1 sm:mb-2">No messages yet</h3>
                <p class="text-slate-600 text-sm sm:text-base">Messages from recruiters and employers will appear here</p>
            </div>
        </div>
    @else
        {{-- MOBILE VIEW: Show conversation list OR chat (not both) --}}
        @if(!empty($hasExplicitSelection) && $selectedConversation)
        <div class="md:hidden msg-container-chat flex flex-col bg-white">
                {{-- MOBILE CHAT VIEW --}}
                @php $otherUser = $selectedConversation->getOtherUser(auth()->user()->id); @endphp

                {{-- Chat Header with back button --}}
                <div class="bg-white border-b border-slate-100 px-3 py-2.5 flex-shrink-0 flex items-center gap-2.5 safe-area-top">
                    <a href="{{ route('candidate.messages') }}" class="flex items-center justify-center h-9 w-9 rounded-full hover:bg-slate-100 transition flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center flex-shrink-0">
                        <span class="text-sm font-semibold text-white">{{ substr($otherUser->name ?? 'U', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-sm font-semibold text-slate-900 truncate">{{ $otherUser->name ?? 'User' }}</h2>
                        @if($selectedConversation->jobApplication && $selectedConversation->jobApplication->jobPost)
                            <p class="text-[11px] text-slate-500 truncate leading-tight">{{ $selectedConversation->jobApplication->jobPost->title }}</p>
                        @endif
                    </div>
                </div>

                {{-- Messages --}}
                <div class="flex-1 overflow-y-auto px-3 py-3 space-y-3 bg-[#f1f5f9]" id="messagesContainerMobile">
                    @forelse($messages as $message)
                        @php $isSender = $message->sender_id == auth()->user()->id; @endphp
                        <div class="flex {{ $isSender ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                            <div class="max-w-[80%]">
                                @if($message->type === 'text')
                                    <div class="rounded-2xl px-3 py-2 {{ $isSender ? 'bg-slate-900 text-white rounded-br-md' : 'bg-white text-slate-900 shadow-sm border border-slate-100 rounded-bl-md' }}">
                                        <p class="text-[13px] leading-relaxed break-words">{{ $message->message }}</p>
                                    </div>
                                @elseif(str_starts_with($message->type, 'request_') && !$isSender)
                                    <div class="rounded-2xl rounded-bl-md px-3 py-2 bg-blue-50 border border-blue-200">
                                        <div class="flex items-center gap-1.5 mb-1.5">
                                            <span class="text-base">
                                                @if($message->type === 'request_contact') 📞
                                                @elseif($message->type === 'request_email') 📧
                                                @elseif($message->type === 'request_resume') 📄
                                                @elseif($message->type === 'request_location') 📍
                                                @endif
                                            </span>
                                            @if($message->request_status === 'pending')
                                                <span class="text-[10px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded-full font-medium">Pending</span>
                                            @elseif($message->request_status === 'approved')
                                                <span class="text-[10px] bg-green-100 text-green-800 px-1.5 py-0.5 rounded-full font-medium">Approved</span>
                                            @elseif($message->request_status === 'declined')
                                                <span class="text-[10px] bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full font-medium">Declined</span>
                                            @endif
                                        </div>
                                        <p class="text-[13px] break-words text-slate-900 mb-2">{{ $message->message }}</p>
                                        @if($message->request_status === 'pending')
                                            <div class="flex gap-2 request-actions-{{ $message->id }}">
                                                @if($message->type === 'request_contact')
                                                    <button onclick="showContactForm({{ $message->id }})" class="text-[11px] px-2.5 py-1 rounded-lg bg-green-600 text-white font-medium">Share Contact</button>
                                                @elseif($message->type === 'request_email')
                                                    <button onclick="showEmailForm({{ $message->id }})" class="text-[11px] px-2.5 py-1 rounded-lg bg-green-600 text-white font-medium">Share Email</button>
                                                @elseif($message->type === 'request_resume')
                                                    <button onclick="showResumeForm({{ $message->id }})" class="text-[11px] px-2.5 py-1 rounded-lg bg-green-600 text-white font-medium">Share Resume</button>
                                                @endif
                                                <button onclick="declineRequest({{ $message->id }})" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-200 text-slate-700 font-medium">Decline</button>
                                            </div>
                                        @endif
                                    </div>
                                @elseif(str_starts_with($message->type, 'request_') && $isSender)
                                    <div class="rounded-2xl rounded-br-md px-3 py-2 bg-purple-50 border border-purple-200">
                                        <div class="flex items-center gap-1.5 mb-1">
                                            <span class="text-base">
                                                @if($message->type === 'request_contact') 📞
                                                @elseif($message->type === 'request_email') 📧
                                                @elseif($message->type === 'request_resume') 📄
                                                @elseif($message->type === 'request_location') 📍
                                                @endif
                                            </span>
                                            @if($message->request_status === 'pending')
                                                <span class="text-[10px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded-full font-medium">Pending</span>
                                            @elseif($message->request_status === 'approved')
                                                <span class="text-[10px] bg-green-100 text-green-800 px-1.5 py-0.5 rounded-full font-medium">Approved</span>
                                            @elseif($message->request_status === 'declined')
                                                <span class="text-[10px] bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full font-medium">Declined</span>
                                            @endif
                                        </div>
                                        <p class="text-[13px] break-words text-slate-900">{{ $message->message }}</p>
                                    </div>
                                @elseif(str_contains($message->type, '_response'))
                                    <div class="rounded-2xl px-3 py-2 {{ $isSender ? 'bg-green-50 border border-green-200 text-slate-900 rounded-br-md' : 'bg-slate-900 text-white rounded-bl-md' }}">
                                        <p class="text-[13px] break-words font-semibold">✓ {{ $message->message }}</p>
                                        @if($message->phone) <p class="text-xs mt-1">Phone: {{ $message->phone }}</p> @endif
                                        @if($message->email) <p class="text-xs mt-1">Email: {{ $message->email }}</p> @endif
                                        @if($message->cv_file)
                                            <a href="{{ asset('storage/' . $message->cv_file) }}" target="_blank" class="text-xs text-blue-500 hover:underline mt-1 block">📎 Download Resume</a>
                                        @endif
                                    </div>
                                @endif
                                <p class="text-[10px] text-slate-400 mt-0.5 {{ $isSender ? 'text-right' : 'text-left' }}">
                                    {{ $message->created_at->format('h:i A') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-slate-400 text-sm py-12">
                            No messages yet. Start the conversation!
                        </div>
                    @endforelse
                </div>

                {{-- Mobile Input --}}
                <div class="border-t border-slate-100 bg-white flex-shrink-0 safe-area-bottom">
                    {{-- Quick request chips --}}
                    <div class="flex gap-1.5 px-3 pt-2 pb-1 overflow-x-auto scrollbar-hide">
                        <button type="button" onclick="sendRequest('request_contact')" class="text-[11px] px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 flex items-center gap-1 whitespace-nowrap flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            Contact
                        </button>
                        <button type="button" onclick="sendRequest('request_email')" class="text-[11px] px-2.5 py-1 rounded-full bg-green-50 text-green-700 border border-green-200 flex items-center gap-1 whitespace-nowrap flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            Email
                        </button>
                        <button type="button" onclick="sendRequest('request_location')" class="text-[11px] px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1 whitespace-nowrap flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Location
                        </button>
                    </div>
                    <form id="messageFormMobile" class="flex items-center gap-2 px-3 pb-2 pt-1">
                        @csrf
                        <input type="text" id="messageInputMobile" name="message" placeholder="Type a message..." required autocomplete="off"
                               class="flex-1 rounded-full border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-transparent bg-white">
                        <button type="submit" class="h-9 w-9 rounded-full bg-slate-900 flex items-center justify-center flex-shrink-0 hover:bg-black transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                    <div id="typingIndicatorMobile" class="text-[11px] text-slate-500 px-3 pb-1 hidden"></div>
                </div>
        </div>
        @else
        {{-- MOBILE CONVERSATION LIST --}}
        <div class="md:hidden msg-container flex flex-col bg-[#f8fafc]">
                <div class="bg-white border-b border-slate-100 px-4 py-3 flex-shrink-0">
                    <h1 class="text-xl font-bold text-slate-900">Messages</h1>
                </div>
                <div class="flex-1 overflow-y-auto py-1">
                    @foreach($conversations as $conversation)
                        @php
                            $otherUser = $conversation->getOtherUser(auth()->user()->id);
                            $unreadCount = $conversation->messages()->where('sender_id', '!=', auth()->user()->id)->where('is_seen', false)->count();
                        @endphp
                        <a href="{{ route('candidate.messages', ['conversation_id' => $conversation->id]) }}" 
                           class="flex items-center gap-3 mx-3 my-1.5 px-3 py-3 bg-white rounded-xl hover:bg-slate-50 active:bg-slate-100 transition shadow-sm">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-semibold text-white">{{ substr($otherUser->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-sm font-semibold text-slate-900 truncate">{{ $otherUser->name ?? 'User' }}</h3>
                                    <span class="text-[10px] text-slate-400 flex-shrink-0">
                                        {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans(null, true) : '' }}
                                    </span>
                                </div>
                                @if($conversation->jobApplication && $conversation->jobApplication->jobPost)
                                    <p class="text-[11px] text-slate-500 truncate">{{ $conversation->jobApplication->jobPost->title }}</p>
                                @endif
                                <div class="flex items-center justify-between gap-2 mt-0.5">
                                    @if($conversation->lastMessage)
                                        <p class="text-xs text-slate-500 truncate">{{ Str::limit($conversation->lastMessage->message, 45) }}</p>
                                    @else
                                        <p class="text-xs text-slate-400 italic">No messages</p>
                                    @endif
                                    @if($unreadCount > 0)
                                        <span class="inline-flex items-center justify-center h-5 min-w-[20px] rounded-full bg-slate-900 text-white text-[10px] font-bold px-1 flex-shrink-0">
                                            {{ $unreadCount }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
        </div>
        @endif

        {{-- DESKTOP VIEW: Side-by-side layout --}}
        <div class="hidden md:flex msg-container pt-14">
            {{-- Conversations Sidebar --}}
            <div class="w-80 lg:w-96 border-r border-slate-100 bg-[#f8fafc] flex flex-col flex-shrink-0">
                <div class="border-b border-slate-100 px-5 py-4 flex-shrink-0">
                    <h1 class="text-lg font-bold text-slate-900">Messages</h1>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $conversations->count() }} conversation{{ $conversations->count() !== 1 ? 's' : '' }}</p>
                </div>
                <div class="flex-1 overflow-y-auto py-1">
                    @foreach($conversations as $conversation)
                        @php
                            $otherUser = $conversation->getOtherUser(auth()->user()->id);
                            $isSelected = $selectedConversationId == $conversation->id;
                            $unreadCount = $conversation->messages()->where('sender_id', '!=', auth()->user()->id)->where('is_seen', false)->count();
                        @endphp
                        <a href="{{ route('candidate.messages', ['conversation_id' => $conversation->id]) }}" 
                           class="flex items-center gap-3 mx-3 my-1.5 px-3 py-3 rounded-xl transition shadow-sm {{ $isSelected ? 'bg-blue-50 border border-blue-200' : 'bg-white hover:bg-slate-50' }}">
                            <div class="h-11 w-11 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-semibold text-white">{{ substr($otherUser->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h3 class="text-sm font-semibold truncate text-slate-900 {{ $unreadCount > 0 ? 'font-bold' : '' }}">{{ $otherUser->name ?? 'User' }}</h3>
                                    <span class="text-[10px] flex-shrink-0 text-slate-400">
                                        {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans(null, true) : '' }}
                                    </span>
                                </div>
                                @if($conversation->jobApplication && $conversation->jobApplication->jobPost)
                                    <p class="text-[11px] truncate text-slate-500">{{ $conversation->jobApplication->jobPost->title }}</p>
                                @endif
                                <div class="flex items-center justify-between gap-2 mt-0.5">
                                    @if($conversation->lastMessage)
                                        <p class="text-xs truncate {{ $unreadCount > 0 ? 'font-medium text-slate-700' : 'text-slate-500' }}">{{ Str::limit($conversation->lastMessage->message, 35) }}</p>
                                    @endif
                                    @if($unreadCount > 0)
                                        <span class="inline-flex items-center justify-center h-5 min-w-[20px] rounded-full bg-blue-600 text-white text-[10px] font-bold px-1 flex-shrink-0">{{ $unreadCount }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Chat Area --}}
            <div class="flex-1 flex flex-col bg-white min-w-0">
                @if($selectedConversation)
                    @php $otherUser = $selectedConversation->getOtherUser(auth()->user()->id); @endphp

                    {{-- Chat Header --}}
                    <div class="border-b border-slate-100 px-6 py-3.5 flex-shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="h-11 w-11 rounded-full bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-semibold text-white">{{ substr($otherUser->name ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h2 class="text-base font-semibold text-slate-900 truncate">{{ $otherUser->name ?? 'User' }}</h2>
                                @if($selectedConversation->jobApplication && $selectedConversation->jobApplication->jobPost)
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $selectedConversation->jobApplication->jobPost->title }} at {{ $selectedConversation->jobApplication->jobPost->company->name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Messages --}}
                    <div class="flex-1 overflow-y-auto px-6 py-4 space-y-3 bg-[#f1f5f9]" id="messagesContainer">
                        @forelse($messages as $message)
                            @php $isSender = $message->sender_id == auth()->user()->id; @endphp
                            <div class="flex {{ $isSender ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                                <div class="max-w-[65%]">
                                    @if($message->type === 'text')
                                        <div class="rounded-2xl px-4 py-2.5 {{ $isSender ? 'bg-slate-900 text-white rounded-br-md' : 'bg-white text-slate-900 shadow-sm border border-slate-100 rounded-bl-md' }}">
                                            <p class="text-sm break-words leading-relaxed">{{ $message->message }}</p>
                                        </div>
                                    @elseif(str_starts_with($message->type, 'request_') && !$isSender)
                                        <div class="rounded-2xl rounded-bl-md px-4 py-2.5 bg-blue-50 border border-blue-200">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-lg">
                                                    @if($message->type === 'request_contact') 📞
                                                    @elseif($message->type === 'request_email') 📧
                                                    @elseif($message->type === 'request_resume') 📄
                                                    @elseif($message->type === 'request_location') 📍
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
                                            <p class="text-sm break-words text-slate-900 mb-3">{{ $message->message }}</p>
                                            @if($message->request_status === 'pending')
                                                <div class="flex gap-2 request-actions-{{ $message->id }}">
                                                    @if($message->type === 'request_contact')
                                                        <button onclick="showContactForm({{ $message->id }})" class="text-xs px-3 py-1.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">Share Contact</button>
                                                    @elseif($message->type === 'request_email')
                                                        <button onclick="showEmailForm({{ $message->id }})" class="text-xs px-3 py-1.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">Share Email</button>
                                                    @elseif($message->type === 'request_resume')
                                                        <button onclick="showResumeForm({{ $message->id }})" class="text-xs px-3 py-1.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">Share Resume</button>
                                                    @endif
                                                    <button onclick="declineRequest({{ $message->id }})" class="text-xs px-3 py-1.5 rounded-lg bg-slate-200 text-slate-700 hover:bg-slate-300 transition">Decline</button>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif(str_starts_with($message->type, 'request_') && $isSender)
                                        <div class="rounded-2xl rounded-br-md px-4 py-2.5 bg-purple-50 border border-purple-200">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-lg">
                                                    @if($message->type === 'request_contact') 📞
                                                    @elseif($message->type === 'request_email') 📧
                                                    @elseif($message->type === 'request_resume') 📄
                                                    @elseif($message->type === 'request_location') 📍
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
                                            <p class="text-sm break-words text-slate-900">{{ $message->message }}</p>
                                        </div>
                                    @elseif(str_contains($message->type, '_response'))
                                        <div class="rounded-2xl px-4 py-2.5 {{ $isSender ? 'bg-green-50 border border-green-200 text-slate-900 rounded-br-md' : 'bg-slate-900 text-white rounded-bl-md' }}">
                                            <p class="text-sm break-words font-semibold">✓ {{ $message->message }}</p>
                                            @if($message->phone) <p class="text-sm mt-1">Phone: {{ $message->phone }}</p> @endif
                                            @if($message->email) <p class="text-sm mt-1">Email: {{ $message->email }}</p> @endif
                                            @if($message->cv_file)
                                                <a href="{{ asset('storage/' . $message->cv_file) }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 block">📎 Download Resume</a>
                                            @endif
                                        </div>
                                    @endif
                                    <p class="text-[10px] text-slate-400 mt-1 {{ $isSender ? 'text-right' : 'text-left' }}">
                                        {{ $message->created_at->format('M d, Y · h:i A') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-slate-400 text-sm py-12">
                                No messages yet. Start the conversation!
                            </div>
                        @endforelse
                    </div>

                    {{-- Desktop Input --}}
                    <div class="border-t border-slate-100 px-6 py-3 flex-shrink-0 bg-white">
                        <div class="flex gap-2 mb-2.5">
                            <button type="button" onclick="sendRequest('request_contact')" class="text-xs px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition border border-blue-200 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                Request Contact
                            </button>
                            <button type="button" onclick="sendRequest('request_email')" class="text-xs px-3 py-1.5 rounded-lg bg-green-50 text-green-700 hover:bg-green-100 transition border border-green-200 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                Request Email
                            </button>
                            <button type="button" onclick="sendRequest('request_location')" class="text-xs px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition border border-amber-200 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Request Location
                            </button>
                        </div>
                        <form id="messageForm" class="flex gap-2">
                            @csrf
                            <input type="text" id="messageInput" name="message" placeholder="Type your message..." required autocomplete="off"
                                   class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-transparent bg-white">
                            <button type="submit" class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-black flex items-center gap-2">
                                Send
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                        <div id="typingIndicator" class="text-xs text-slate-500 mt-1.5 hidden"></div>
                    </div>
                @else
                    {{-- No conversation selected --}}
                    <div class="flex-1 flex items-center justify-center bg-[#f1f5f9]">
                        <div class="text-center">
                            <div class="h-20 w-20 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-1">Select a conversation</h3>
                            <p class="text-slate-500 text-sm">Choose a conversation from the list to view messages</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Socket.IO Real-time Chat Script --}}
        @if($selectedConversation)
            <script type="module">
                import { io } from 'https://cdn.socket.io/4.7.2/socket.io.esm.min.js';

                const userId = {{ auth()->user()->id }};
                const userName = "{{ auth()->user()->name }}";
                const userType = "candidate";
                const conversationId = {{ $selectedConversation->id }};
                const isMobile = window.innerWidth < 768;
                
                // Get the correct elements based on viewport
                const formId = isMobile ? 'messageFormMobile' : 'messageForm';
                const inputId = isMobile ? 'messageInputMobile' : 'messageInput';
                const containerId = isMobile ? 'messagesContainerMobile' : 'messagesContainer';
                const typingId = isMobile ? 'typingIndicatorMobile' : 'typingIndicator';

                // Connect to Socket.IO server
                const socket = io('http://localhost:3000', {
                    auth: { userId: userId, userType: userType }
                });

                socket.on('connect', () => {
                    console.log('Socket.IO connected');
                    socket.emit('join-conversations', [conversationId]);
                });

                socket.on('connect_error', (error) => {
                    console.error('Socket.IO connection error:', error.message);
                });

                // Listen for new messages
                socket.on('new-message', (data) => {
                    if (data.conversationId == conversationId) {
                        const message = data.message;
                        if (message.sender_id != userId) {
                            addMessageToUI(message);
                            scrollToBottom();
                        }
                    }
                });

                // Listen for typing indicators
                socket.on('user-typing', (data) => {
                    if (data.conversationId == conversationId && data.userId != userId) {
                        const indicator = document.getElementById(typingId);
                        if (indicator) {
                            indicator.textContent = `${data.userName} is typing...`;
                            indicator.classList.remove('hidden');
                        }
                    }
                });

                socket.on('user-stop-typing', (data) => {
                    if (data.conversationId == conversationId && data.userId != userId) {
                        const indicator = document.getElementById(typingId);
                        if (indicator) indicator.classList.add('hidden');
                    }
                });

                // Handle form submission (both mobile and desktop)
                const form = document.getElementById(formId);
                const input = document.getElementById(inputId);

                if (form && input) {
                    form.addEventListener('submit', async (e) => {
                        e.preventDefault();
                        const messageText = input.value.trim();
                        if (!messageText) return;

                        input.disabled = true;

                        try {
                            const response = await fetch('{{ route("candidate.message.send.api", $selectedConversation->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ message: messageText, type: 'text' })
                            });

                            const result = await response.json();
                            
                            if (result.success) {
                                addMessageToUI(result.message, true);
                                socket.emit('send-message', {
                                    conversationId: conversationId,
                                    message: result.message,
                                    senderId: userId,
                                    senderName: userName,
                                    senderAvatar: null
                                });
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

                    // Typing indicator
                    let typingTimeout;
                    input.addEventListener('input', () => {
                        socket.emit('typing', { conversationId, userName });
                        clearTimeout(typingTimeout);
                        typingTimeout = setTimeout(() => {
                            socket.emit('stop-typing', { conversationId });
                        }, 1000);
                    });
                }

                // Add message to UI
                function addMessageToUI(message, isSender = false) {
                    const container = document.getElementById(containerId);
                    if (!container) return;
                    
                    if (message.sender_id == userId) isSender = true;
                    
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `flex ${isSender ? 'justify-end' : 'justify-start'}`;
                    messageDiv.setAttribute('data-message-id', message.id);
                    
                    const date = new Date(message.created_at);
                    const timeStr = date.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                    const fullDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' · ' + timeStr;
                    const displayDate = isMobile ? timeStr : fullDate;
                    
                    let messageContent = '';
                    const maxW = isMobile ? 'max-w-[80%]' : 'max-w-[65%]';
                    const senderBubble = isSender 
                        ? 'bg-slate-900 text-white rounded-br-md' 
                        : (isMobile ? 'bg-white text-slate-900 shadow-sm border border-slate-100 rounded-bl-md' : 'bg-white text-slate-900 shadow-sm border border-slate-100 rounded-bl-md');
                    
                    if (message.type === 'text') {
                        messageContent = `
                            <div class="rounded-2xl px-3 ${isMobile ? 'px-3 py-2' : 'px-4 py-2.5'} ${isSender ? 'bg-slate-900 text-white rounded-br-md' : 'bg-white text-slate-900 shadow-sm border border-slate-100 rounded-bl-md'}">
                                <p class="${isMobile ? 'text-[13px]' : 'text-sm'} break-words leading-relaxed">${escapeHtml(message.message)}</p>
                            </div>
                        `;
                    } else if (message.type.startsWith('request_') && !isSender) {
                        const requestIcon = message.type === 'request_contact' ? '📞' : 
                                           message.type === 'request_email' ? '📧' : 
                                           message.type === 'request_location' ? '📍' : '📄';
                        const statusBadge = message.request_status === 'pending' ? '<span class="text-[10px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded-full font-medium">Pending</span>' :
                                           message.request_status === 'approved' ? '<span class="text-[10px] bg-green-100 text-green-800 px-1.5 py-0.5 rounded-full font-medium">Approved</span>' :
                                           message.request_status === 'declined' ? '<span class="text-[10px] bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full font-medium">Declined</span>' : '';
                        
                        let actionButtons = '';
                        if (message.request_status === 'pending') {
                            const actionType = message.type === 'request_contact' ? 'showContactForm' :
                                              message.type === 'request_email' ? 'showEmailForm' : 'showResumeForm';
                            const actionLabel = message.type === 'request_contact' ? 'Share Contact' :
                                               message.type === 'request_email' ? 'Share Email' : 'Share Resume';
                            actionButtons = `
                                <div class="flex gap-2 request-actions-${message.id} mt-2">
                                    <button onclick="${actionType}(${message.id})" class="text-[11px] px-2.5 py-1 rounded-lg bg-green-600 text-white font-medium">${actionLabel}</button>
                                    <button onclick="declineRequest(${message.id})" class="text-[11px] px-2.5 py-1 rounded-lg bg-slate-200 text-slate-700 font-medium">Decline</button>
                                </div>
                            `;
                        }
                        
                        messageContent = `
                            <div class="rounded-2xl rounded-bl-md px-3 py-2 bg-blue-50 border border-blue-200">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <span class="text-base">${requestIcon}</span>
                                    ${statusBadge}
                                </div>
                                <p class="${isMobile ? 'text-[13px]' : 'text-sm'} break-words text-slate-900">${escapeHtml(message.message)}</p>
                                ${actionButtons}
                            </div>
                        `;
                    } else if (message.type.startsWith('request_') && isSender) {
                        const requestIcon = message.type === 'request_contact' ? '📞' : 
                                           message.type === 'request_email' ? '📧' : 
                                           message.type === 'request_location' ? '📍' : '📄';
                        const statusBadge = message.request_status === 'pending' ? '<span class="text-[10px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded-full font-medium">Pending</span>' :
                                           message.request_status === 'approved' ? '<span class="text-[10px] bg-green-100 text-green-800 px-1.5 py-0.5 rounded-full font-medium">Approved</span>' :
                                           message.request_status === 'declined' ? '<span class="text-[10px] bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full font-medium">Declined</span>' : '';
                        
                        messageContent = `
                            <div class="rounded-2xl rounded-br-md px-3 py-2 bg-purple-50 border border-purple-200">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="text-base">${requestIcon}</span>
                                    ${statusBadge}
                                </div>
                                <p class="${isMobile ? 'text-[13px]' : 'text-sm'} break-words text-slate-900">${escapeHtml(message.message)}</p>
                            </div>
                        `;
                    } else if (message.type.includes('_response')) {
                        messageContent = `
                            <div class="rounded-2xl px-3 py-2 ${isSender ? 'bg-green-50 border border-green-200 text-slate-900 rounded-br-md' : 'bg-slate-900 text-white rounded-bl-md'}">
                                <p class="${isMobile ? 'text-[13px]' : 'text-sm'} break-words font-semibold">✓ ${escapeHtml(message.message)}</p>
                                ${message.phone ? `<p class="text-xs mt-1">Phone: ${escapeHtml(message.phone)}</p>` : ''}
                                ${message.email ? `<p class="text-xs mt-1">Email: ${escapeHtml(message.email)}</p>` : ''}
                                ${message.cv_file ? `<a href="/storage/${message.cv_file}" target="_blank" class="text-xs text-blue-500 hover:underline mt-1 block">📎 Download Resume</a>` : ''}
                            </div>
                        `;
                    }
                    
                    messageDiv.innerHTML = `
                        <div class="${maxW}">
                            ${messageContent}
                            <p class="text-[10px] text-slate-400 mt-0.5 ${isSender ? 'text-right' : 'text-left'}">
                                ${displayDate}
                            </p>
                        </div>
                    `;
                    
                    container.appendChild(messageDiv);
                }

                // Scroll to bottom
                function scrollToBottom() {
                    const container = document.getElementById(containerId);
                    if (container) container.scrollTop = container.scrollHeight;
                }

                // HTML escape helper
                function escapeHtml(text) {
                    const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
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

                // Show resume form
                window.showResumeForm = function(messageId) {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = '.pdf,.doc,.docx';
                    input.onchange = async (e) => {
                        const file = e.target.files[0];
                        if (file) {
                            const formData = new FormData();
                            formData.append('resume', file);
                            await respondToRequest(messageId, formData, true);
                        }
                    };
                    input.click();
                };

                // Respond to request
                async function respondToRequest(messageId, data, isFile = false) {
                    try {
                        const headers = { 'X-CSRF-TOKEN': '{{ csrf_token() }}' };
                        let body;
                        if (isFile) {
                            body = data;
                        } else {
                            headers['Content-Type'] = 'application/json';
                            body = JSON.stringify(data);
                        }

                        const response = await fetch('{{ route("candidate.request.respond", ":id") }}'.replace(':id', messageId), {
                            method: 'POST', headers: headers, body: body
                        });

                        const result = await response.json();
                        
                        if (result.success) {
                            document.querySelectorAll(`.request-actions-${messageId}`).forEach(el => el.remove());
                            addMessageToUI(result.message, true);
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
                    if (!confirm('Are you sure you want to decline this request?')) return;

                    try {
                        const response = await fetch('{{ route("candidate.request.decline", ":id") }}'.replace(':id', messageId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        const result = await response.json();
                        
                        if (result.success) {
                            document.querySelectorAll(`.request-actions-${messageId}`).forEach(el => el.remove());
                            addMessageToUI(result.message, true);
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

                // Send request to recruiter
                window.sendRequest = async function(type) {
                    try {
                        const response = await fetch('{{ route("candidate.message.send.api", $selectedConversation->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ type: type })
                        });

                        const result = await response.json();
                        
                        if (result.success) {
                            addMessageToUI(result.message, true);
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

                // Initial scroll to bottom
                document.addEventListener('DOMContentLoaded', () => scrollToBottom());
            </script>
        @endif
    @endif
@endsection
