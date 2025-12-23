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
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Video Call
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
                                @elseif($message->type === 'image')
                                    <div class="rounded-lg overflow-hidden {{ $message->sender_id === auth()->id() ? 'bg-blue-600' : 'bg-gray-200 dark:bg-slate-700' }}">
                                        @if(isset($message->metadata['image_url']))
                                            <img src="{{ $message->metadata['image_url'] }}" alt="Image" class="max-w-full h-auto cursor-pointer hover:opacity-90 transition" onclick="openImageModal(this.src)" style="max-height: 300px;">
                                        @endif
                                        @if($message->message)
                                            <p class="text-sm p-2 {{ $message->sender_id === auth()->id() ? 'text-white' : 'text-gray-900 dark:text-white' }}">{{ $message->message }}</p>
                                        @endif
                                    </div>
                                @elseif($message->type === 'video_call')
                                    <div class="rounded-lg p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                                        <div class="flex items-center space-x-2 text-sm text-green-700 dark:text-green-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-medium">Video Call</span>
                                        </div>
                                        @if(isset($message->metadata['jitsi_link']))
                                            <a href="{{ $message->metadata['jitsi_link'] }}" target="_blank" 
                                               class="mt-2 inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                                Join Video Call
                                            </a>
                                        @elseif(isset($message->metadata['meet_link']))
                                            <a href="{{ $message->metadata['meet_link'] }}" target="_blank" 
                                               class="mt-2 inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition">
                                                Join Call
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Image Preview -->
                <div id="imagePreviewContainer" class="hidden border-t border-gray-200 dark:border-gray-700 p-3 bg-gray-50 dark:bg-slate-700">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img id="imagePreview" src="" alt="Preview" class="h-20 w-20 object-cover rounded-lg">
                            <button type="button" id="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Gambar siap dikirim</span>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                    <form id="messageForm" class="flex items-center space-x-3" enctype="multipart/form-data">
                        @csrf
                        <!-- Image Upload Button -->
                        <label for="imageInput" class="cursor-pointer p-2 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </label>
                        <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
                        
                        <input type="text" 
                               id="messageInput" 
                               name="message" 
                               placeholder="Ketik pesan..."
                               class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                        
                        <button type="submit" 
                                id="sendButton"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white font-medium rounded-lg transition min-w-[80px]">
                            <span id="sendButtonText">Kirim</span>
                            <svg id="sendButtonLoading" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="modalImage" src="" alt="Full Image" class="max-w-full max-h-full object-contain">
    </div>

    <!-- Jitsi Meet Modal -->
    <div id="jitsiModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95">
        <div class="absolute top-4 right-4 z-10">
            <button onclick="closeJitsiModal()" class="text-white hover:text-gray-300 transition bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-medium">
                Tutup Video Call
            </button>
        </div>
        <div id="jitsiContainer" class="w-full h-full"></div>
    </div>

    <!-- Jitsi Meet API -->
    <script src="https://meet.jit.si/external_api.js"></script>
    
    <script>
        const conversationId = {{ $conversation->id }};
        let lastMessageId = {{ $messages->last() ? $messages->last()->id : 0 }};
        let pollIntervalId = null;
        let isSending = false;
        let selectedImage = null;
        let jitsiApi = null;

        // Image Modal
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Jitsi Modal
        function openJitsiModal(roomName, displayName) {
            document.getElementById('jitsiModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            const domain = 'meet.jit.si';
            const options = {
                roomName: roomName,
                width: '100%',
                height: '100%',
                parentNode: document.getElementById('jitsiContainer'),
                userInfo: {
                    displayName: displayName || '{{ auth()->user()->name }}'
                },
                configOverwrite: {
                    startWithAudioMuted: false,
                    startWithVideoMuted: false,
                    prejoinPageEnabled: false,
                },
                interfaceConfigOverwrite: {
                    TOOLBAR_BUTTONS: [
                        'microphone', 'camera', 'desktop', 'fullscreen',
                        'fodeviceselection', 'hangup', 'chat', 'settings',
                        'raisehand', 'videoquality', 'tileview'
                    ],
                    SHOW_JITSI_WATERMARK: false,
                    SHOW_WATERMARK_FOR_GUESTS: false,
                    DEFAULT_BACKGROUND: '#1e293b',
                }
            };
            
            jitsiApi = new JitsiMeetExternalAPI(domain, options);
            
            jitsiApi.addEventListener('readyToClose', () => {
                closeJitsiModal();
            });
        }

        function closeJitsiModal() {
            if (jitsiApi) {
                jitsiApi.dispose();
                jitsiApi = null;
            }
            document.getElementById('jitsiContainer').innerHTML = '';
            document.getElementById('jitsiModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Image Upload Preview
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 5MB');
                    this.value = '';
                    return;
                }
                
                selectedImage = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('removeImage').addEventListener('click', function() {
            selectedImage = null;
            document.getElementById('imageInput').value = '';
            document.getElementById('imagePreviewContainer').classList.add('hidden');
        });

        // Send Message
        document.getElementById('messageForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            if (isSending) return;
            
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();
            const sendButton = document.getElementById('sendButton');
            const sendButtonText = document.getElementById('sendButtonText');
            const sendButtonLoading = document.getElementById('sendButtonLoading');
            
            if (!message && !selectedImage) return;

            isSending = true;
            sendButton.disabled = true;
            sendButtonText.classList.add('hidden');
            sendButtonLoading.classList.remove('hidden');

            const url = `{{ auth()->user()->isDoctor() ? route('doctor.chat.send', $conversation) : route('chat.send', $conversation) }}`;

            try {
                let response;
                
                if (selectedImage) {
                    const formData = new FormData();
                    formData.append('image', selectedImage);
                    formData.append('message', message);
                    formData.append('type', 'image');
                    
                    response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });
                } else {
                    response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message, type: 'text' })
                    });
                }

                const data = await response.json();
                
                if (data.success) {
                    messageInput.value = '';
                    
                    if (selectedImage) {
                        selectedImage = null;
                        document.getElementById('imageInput').value = '';
                        document.getElementById('imagePreviewContainer').classList.add('hidden');
                    }
                    
                    if (data.message) {
                        renderIncomingMessage(data.message);
                        lastMessageId = Math.max(lastMessageId, data.message.id);
                    }
                } else {
                    alert('Gagal mengirim pesan: ' + (data.error || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengirim pesan');
            } finally {
                isSending = false;
                sendButton.disabled = false;
                sendButtonText.classList.remove('hidden');
                sendButtonLoading.classList.add('hidden');
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
            
            if (document.querySelector(`[data-message-id="${message.id}"]`)) return;
            
            const wrapper = document.createElement('div');
            wrapper.className = `flex ${isMine ? 'justify-end' : 'justify-start'}`;
            wrapper.dataset.messageId = message.id;

            if (message.type === 'text') {
                const bubbleClass = isMine ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-white';
                wrapper.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg p-3 ${bubbleClass}">
                            <p class="text-sm">${escapeHtml(message.message || '')}</p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ${isMine ? 'text-right' : 'text-left'}">${formatTime(message.created_at)}</p>
                    </div>
                `;
            } else if (message.type === 'image') {
                const bubbleClass = isMine ? 'bg-blue-600' : 'bg-gray-200 dark:bg-slate-700';
                const textClass = isMine ? 'text-white' : 'text-gray-900 dark:text-white';
                const imageUrl = message.metadata?.image_url || '';
                wrapper.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg overflow-hidden ${bubbleClass}">
                            ${imageUrl ? `<img src="${imageUrl}" alt="Image" class="max-w-full h-auto cursor-pointer hover:opacity-90 transition" style="max-height: 300px;" onclick="openImageModal(this.src)">` : ''}
                            ${message.message ? `<p class="text-sm p-2 ${textClass}">${escapeHtml(message.message)}</p>` : ''}
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ${isMine ? 'text-right' : 'text-left'}">${formatTime(message.created_at)}</p>
                    </div>
                `;
            } else if (message.type === 'video_call') {
                const jitsiLink = message.metadata?.jitsi_link || message.metadata?.meet_link || '';
                const roomName = message.metadata?.room_name || '';
                wrapper.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                            <div class="flex items-center space-x-2 text-sm text-green-700 dark:text-green-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium">Video Call</span>
                            </div>
                            ${jitsiLink ? `
                                <button onclick="openJitsiModal('${roomName}', '{{ auth()->user()->name }}')" class="mt-2 inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Join Video Call
                                </button>
                            ` : ''}
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 ${isMine ? 'text-right' : 'text-left'}">${formatTime(message.created_at)}</p>
                    </div>
                `;
            } else {
                return;
            }

            const atBottom = (messagesArea.scrollHeight - messagesArea.scrollTop - messagesArea.clientHeight) < 120;
            messagesArea.appendChild(wrapper);
            if (atBottom) messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        async function pollNewMessages() {
            try {
                const response = await fetch(`/api/conversations/${conversationId}/messages?after_id=${lastMessageId}`, {
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                if (!response.ok) return;
                const data = await response.json();
                if (!data.success || !Array.isArray(data.messages)) return;
                for (const message of data.messages) {
                    renderIncomingMessage(message);
                    lastMessageId = Math.max(lastMessageId, message.id);
                }
            } catch (e) {}
        }

        async function initiateVideoCall() {
            const btn = document.getElementById('videoCallBtn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memulai...';

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
                
                if (data.success && data.room_name) {
                    if (data.message) {
                        renderIncomingMessage(data.message);
                        lastMessageId = Math.max(lastMessageId, data.message.id || 0);
                    }
                    openJitsiModal(data.room_name, '{{ auth()->user()->name }}');
                } else {
                    alert('Gagal memulai video call');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memulai video call');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Video Call';
            }
        }

        document.getElementById('videoCallBtn').addEventListener('click', initiateVideoCall);

        // Auto scroll
        const messagesArea = document.getElementById('messagesArea');
        if (messagesArea) messagesArea.scrollTop = messagesArea.scrollHeight;

        // Polling
        pollIntervalId = setInterval(pollNewMessages, 2000);
        document.addEventListener('visibilitychange', () => { if (!document.hidden) pollNewMessages(); });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeImageModal();
                closeJitsiModal();
            }
        });
    </script>
</x-app-layout>