<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Chat dengan 
                @if(auth()->user()->isPatient())
                    Dr. {{ $conversation->doctor->user->name }}
                @else
                    {{ $conversation->patient->name }}
                @endif
            </h2>
            <div class="flex space-x-2">
                <button id="videoCallBtn"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Video Call (Google Meet)
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Chat Container -->
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg flex flex-col" style="height: calc(100vh - 200px);">
                <!-- Messages Area -->
                <div id="messagesArea" class="flex-1 overflow-y-auto p-6 space-y-4">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                            <div class="max-w-xs lg:max-w-md">
                                @if($message->type === 'text')
                                    <div class="rounded-lg p-3 {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-white' }}">
                                        <p class="text-sm">{{ $message->message }}</p>
                                    </div>
                                @elseif($message->type === 'video_call')
                                    <div class="rounded-lg p-3 bg-gray-100 dark:bg-slate-700 border border-gray-300 dark:border-gray-600">
                                        <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>Video Call (Google Meet)</span>
                                            @if(isset($message->metadata['meet_link']))
                                                <a href="{{ $message->metadata['meet_link'] }}" target="_blank" class="ml-2 text-blue-600 dark:text-blue-400 hover:underline">Join</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                    <form id="messageForm" class="flex space-x-4">
                        @csrf
                        <input type="text" 
                               id="messageInput" 
                               name="message" 
                               placeholder="Ketik pesan..."
                               class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                               required>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const conversationId = {{ $conversation->id }};
        let lastMessageId = {{ $messages->last() ? $messages->last()->id : 0 }};
        let pollIntervalId = null;
        console.log('Chat script loaded, conversation ID:', conversationId);

        // Send Message
        document.getElementById('messageForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log('Form submitted');
            
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();
            
            console.log('Message:', message);
            
            if (!message) {
                console.log('Empty message, returning');
                return;
            }

            const url = `{{ auth()->user()->isDoctor() ? route('doctor.chat.send', $conversation) : route('chat.send', $conversation) }}`;
            console.log('Sending to URL:', url);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message })
                });

                console.log('Response status:', response.status);
                const data = await response.json();
                console.log('Response data:', data);
                
                if (data.success) {
                    messageInput.value = '';
                    
                    // Add message to UI immediately
                    const messagesArea = document.getElementById('messagesArea');
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex justify-end';
                    messageDiv.innerHTML = `
                        <div class="max-w-xs lg:max-w-md">
                            <div class="rounded-lg p-3 bg-blue-600 text-white">
                                <p class="text-sm">${escapeHtml(message)}</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 text-right">
                                ${formatTime(data.message?.created_at)}
                            </p>
                        </div>
                    `;
                    if (data.message?.id) {
                        messageDiv.dataset.messageId = data.message.id;
                        lastMessageId = Math.max(lastMessageId, data.message.id);
                    }
                    messagesArea.appendChild(messageDiv);
                    messagesArea.scrollTop = messagesArea.scrollHeight;
                    console.log('Message added to UI');
                } else {
                    console.error('Success false:', data);
                    alert('Gagal mengirim pesan: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Gagal mengirim pesan: ' + error.message);
            }
        });

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatTime(isoDateString) {
            const date = isoDateString ? new Date(isoDateString) : new Date();
            return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }

        function renderIncomingMessage(message) {
            const isMine = message.sender_id === {{ auth()->id() }};
            const messagesArea = document.getElementById('messagesArea');
            const wrapper = document.createElement('div');
            wrapper.className = `flex ${isMine ? 'justify-end' : 'justify-start'}`;
            wrapper.dataset.messageId = message.id;

            if (message.type === 'text') {
                const bubbleClass = isMine
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-white';
                wrapper.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg p-3 ${bubbleClass}">
                            <p class="text-sm">${escapeHtml(message.message || '')}</p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ${isMine ? 'text-right' : 'text-left'}">
                            ${formatTime(message.created_at)}
                        </p>
                    </div>
                `;
            } else if (message.type === 'video_call') {
                const meetLink = message.metadata?.meet_link;
                wrapper.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg p-3 bg-gray-100 dark:bg-slate-700 border border-gray-300 dark:border-gray-600">
                            <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span>Video Call (Google Meet)</span>
                                ${meetLink ? `<a href="${meetLink}" target="_blank" class="ml-2 text-blue-600 dark:text-blue-400 hover:underline">Join</a>` : ''}
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ${isMine ? 'text-right' : 'text-left'}">
                            ${formatTime(message.created_at)}
                        </p>
                    </div>
                `;
            } else {
                return;
            }

            const atBottom = (messagesArea.scrollHeight - messagesArea.scrollTop - messagesArea.clientHeight) < 120;
            messagesArea.appendChild(wrapper);
            if (atBottom) {
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }
        }

        async function pollNewMessages() {
            try {
                const response = await fetch(`/api/conversations/${conversationId}/messages?after_id=${lastMessageId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (!response.ok) return;
                const data = await response.json();
                if (!data.success || !Array.isArray(data.messages)) return;

                for (const message of data.messages) {
                    renderIncomingMessage(message);
                    lastMessageId = Math.max(lastMessageId, message.id);
                }
            } catch (e) {
                // ignore transient polling errors
            }
        }

        async function initiateMeetCall() {
            console.log('Creating Google Meet link...');

            try {
                const response = await fetch(`/calls/conversations/${conversationId}/initiate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ type: 'video' })
                });

                const data = await response.json();
                if (!data.success || !data.meet_link) {
                    alert('Gagal membuat link Google Meet');
                    return;
                }

                const meetLink = data.meet_link;

                // Add to UI immediately (avoid waiting for polling)
                if (data.message) {
                    renderIncomingMessage(data.message);
                    lastMessageId = Math.max(lastMessageId, data.message.id || 0);
                } else {
                    // fallback render
                    renderIncomingMessage({
                        id: lastMessageId + 1,
                        sender_id: {{ auth()->id() }},
                        type: 'video_call',
                        metadata: { meet_link: meetLink },
                        created_at: new Date().toISOString(),
                    });
                    lastMessageId = lastMessageId + 1;
                }

                window.open(meetLink, '_blank');
            } catch (error) {
                console.error('Error creating meet link:', error);
                alert('Gagal membuat link Google Meet');
            }
        }

        document.getElementById('videoCallBtn').addEventListener('click', () => {
            console.log('Video call button clicked');
            initiateMeetCall();
        });

        // Auto scroll to bottom
        const messagesArea = document.getElementById('messagesArea');
        if (messagesArea) {
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Start polling for new messages
        pollIntervalId = setInterval(pollNewMessages, 1500);
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) return;
            pollNewMessages();
        });

        console.log('Chat script fully initialized');
    </script>
</x-app-layout>
