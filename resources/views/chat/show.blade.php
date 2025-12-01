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
                <button id="voiceCallBtn"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Voice Call
                </button>
                <button id="videoCallBtn"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
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
            <!-- Call Modal -->
            <div id="callModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-95 z-50 flex items-center justify-center">
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-2xl p-8 max-w-2xl w-full mx-4">
                    <div class="relative">
                        <!-- Video containers -->
                        <div id="videoContainer" class="hidden">
                            <div class="relative">
                                <video id="remoteVideo" class="w-full h-96 bg-gray-900 rounded-xl shadow-lg" autoplay playsinline></video>
                                <video id="localVideo" class="absolute bottom-4 right-4 w-48 h-36 bg-gray-800 rounded-lg shadow-lg border-2 border-white" autoplay muted playsinline></video>
                            </div>
                        </div>
                        
                        <!-- Voice call UI -->
                        <div id="voiceContainer" class="hidden text-center py-16">
                            <!-- Contact Info -->
                            <div class="mb-8">
                                <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-gradient-to-br from-green-400 to-green-600 mb-6 shadow-lg animate-pulse">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    @if(auth()->user()->isPatient())
                                        Dr. {{ $conversation->doctor->user->name }}
                                    @else
                                        {{ $conversation->patient->name }}
                                    @endif
                                </h3>
                                <p id="callStatus" class="text-lg text-green-400 mb-4">Memanggil...</p>
                                <p id="callDuration" class="text-4xl font-mono text-white">00:00</p>
                            </div>
                        </div>

                        <!-- Video call UI overlay -->
                        <div id="videoCallInfo" class="hidden absolute top-4 left-4 bg-black bg-opacity-60 rounded-lg px-4 py-2">
                            <h3 class="text-white font-semibold">
                                @if(auth()->user()->isPatient())
                                    Dr. {{ $conversation->doctor->user->name }}
                                @else
                                    {{ $conversation->patient->name }}
                                @endif
                            </h3>
                            <p id="videoCallDuration" class="text-sm text-green-400">00:00</p>
                        </div>

                        <!-- Call controls -->
                        <div class="flex justify-center items-center space-x-6 mt-8">
                            <!-- Mute button -->
                            <button id="toggleMicrophone" class="group relative p-5 rounded-full bg-slate-700 hover:bg-slate-600 transition-all shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition">Mute</span>
                            </button>
                            
                            <!-- Camera button (video only) -->
                            <button id="toggleCamera" class="hidden group relative p-5 rounded-full bg-slate-700 hover:bg-slate-600 transition-all shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition">Camera</span>
                            </button>
                            
                            <!-- End call button -->
                            <button onclick="endCall()" class="group relative p-6 rounded-full bg-red-600 hover:bg-red-700 transition-all shadow-2xl transform hover:scale-110">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 01.97-.23 11.36 11.36 0 003.57.57 1 1 0 011 1v3.49a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.57 1 1 0 01-.23.97z" transform="rotate(135 12 12)"></path>
                                </svg>
                                <span class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Akhiri Panggilan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Container -->
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg flex flex-col" style="height: calc(100vh - 200px);">
                <!-- Messages Area -->
                <div id="messagesArea" class="flex-1 overflow-y-auto p-6 space-y-4">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md">
                                @if($message->type === 'text')
                                    <div class="rounded-lg p-3 {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-white' }}">
                                        <p class="text-sm">{{ $message->message }}</p>
                                    </div>
                                @elseif($message->type === 'voice_call' || $message->type === 'video_call')
                                    <div class="rounded-lg p-3 bg-gray-100 dark:bg-slate-700 border border-gray-300 dark:border-gray-600">
                                        <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($message->type === 'voice_call')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                @endif
                                            </svg>
                                            <span>{{ $message->type === 'voice_call' ? 'Voice Call' : 'Video Call' }}</span>
                                            @if(isset($message->metadata['duration']))
                                                <span>• {{ gmdate('i:s', $message->metadata['duration']) }}</span>
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
        let localStream = null;
        let peerConnection = null;
        let currentCallSession = null;
        let callDurationInterval = null;

        console.log('Chat script loaded, conversation ID:', conversationId);

        // WebRTC Configuration
        const configuration = {
            iceServers: [
                { urls: 'stun:stun.l.google.com:19302' },
                { urls: 'stun:stun1.l.google.com:19302' }
            ]
        };

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
                                ${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}
                            </p>
                        </div>
                    `;
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

        // Initiate Call (Simulation only - no real call)
        async function initiateCall(type) {
            console.log('Initiating call simulation, type:', type);
            
            // Show call modal immediately
            document.getElementById('callModal').classList.remove('hidden');
            
            if (type === 'video') {
                document.getElementById('videoContainer').classList.remove('hidden');
                document.getElementById('voiceContainer').classList.add('hidden');
                document.getElementById('videoCallInfo').classList.remove('hidden');
                document.getElementById('toggleCamera').classList.remove('hidden');
                
                // Try to get camera/microphone for video preview (optional)
                try {
                    localStream = await navigator.mediaDevices.getUserMedia({ audio: true, video: true });
                    const localVideo = document.getElementById('localVideo');
                    const remoteVideo = document.getElementById('remoteVideo');
                    localVideo.srcObject = localStream;
                    remoteVideo.srcObject = localStream; // Show own video as simulation
                } catch (error) {
                    console.log('Camera access denied or not available, showing placeholder');
                    // Continue without video - just show the UI
                }
                
                // Simulate "connecting" then "connected"
                setTimeout(() => {
                    // Start video call duration timer
                    let videoSeconds = 0;
                    callDurationInterval = setInterval(() => {
                        videoSeconds++;
                        const minutes = Math.floor(videoSeconds / 60);
                        const secs = videoSeconds % 60;
                        document.getElementById('videoCallDuration').textContent = 
                            `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                    }, 1000);
                }, 2000);
                
            } else {
                // Voice call
                document.getElementById('voiceContainer').classList.remove('hidden');
                document.getElementById('videoContainer').classList.add('hidden');
                document.getElementById('videoCallInfo').classList.add('hidden');
                document.getElementById('toggleCamera').classList.add('hidden');
                
                // Try to get microphone (optional)
                try {
                    localStream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
                } catch (error) {
                    console.log('Microphone access denied or not available');
                }
                
                // Simulate "calling" for 2 seconds, then "connected"
                document.getElementById('callStatus').textContent = 'Memanggil...';
                
                setTimeout(() => {
                    document.getElementById('callStatus').textContent = 'Terhubung';
                    
                    // Start call duration timer
                    let seconds = 0;
                    callDurationInterval = setInterval(() => {
                        seconds++;
                        const minutes = Math.floor(seconds / 60);
                        const secs = seconds % 60;
                        document.getElementById('callDuration').textContent = 
                            `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                    }, 1000);
                }, 2000);
            }
        }

        function setupPeerConnection() {
            // Simplified for demo
            console.log('Call session established');
        }

        function setupPeerConnection() {
            // Simplified for demo - in production you'd implement full WebRTC signaling
            console.log('Call session established');
        }

        // End Call (Simulation)
        function endCall() {
            // Stop all media tracks
            if (localStream) {
                localStream.getTracks().forEach(track => track.stop());
                localStream = null;
            }

            // Hide call modal
            document.getElementById('callModal').classList.add('hidden');
            document.getElementById('videoContainer').classList.add('hidden');
            document.getElementById('voiceContainer').classList.add('hidden');

            // Clear interval
            if (callDurationInterval) {
                clearInterval(callDurationInterval);
                callDurationInterval = null;
            }

            // Reset durations
            document.getElementById('callDuration').textContent = '00:00';
            document.getElementById('videoCallDuration').textContent = '00:00';
            document.getElementById('callStatus').textContent = 'Memanggil...';
            
            console.log('Call ended');
        }

        // Toggle microphone
        document.getElementById('toggleMicrophone').addEventListener('click', () => {
            if (localStream) {
                const audioTrack = localStream.getAudioTracks()[0];
                if (audioTrack) {
                    audioTrack.enabled = !audioTrack.enabled;
                    document.getElementById('toggleMicrophone').classList.toggle('bg-red-600');
                    document.getElementById('toggleMicrophone').classList.toggle('bg-slate-700');
                }
            }
        });

        // Toggle camera
        document.getElementById('toggleCamera').addEventListener('click', () => {
            if (localStream) {
                const videoTrack = localStream.getVideoTracks()[0];
                if (videoTrack) {
                    videoTrack.enabled = !videoTrack.enabled;
                    document.getElementById('toggleCamera').classList.toggle('bg-red-600');
                    document.getElementById('toggleCamera').classList.toggle('bg-slate-700');
                }
            }
        });

        // Call button event listeners
        document.getElementById('voiceCallBtn').addEventListener('click', () => {
            console.log('Voice call button clicked');
            initiateCall('voice');
        });

        document.getElementById('videoCallBtn').addEventListener('click', () => {
            console.log('Video call button clicked');
            initiateCall('video');
        });

        // Auto scroll to bottom
        const messagesArea = document.getElementById('messagesArea');
        if (messagesArea) {
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        console.log('Chat script fully initialized');
    </script>
</x-app-layout>
