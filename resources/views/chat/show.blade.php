<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat dengan 
                @if(auth()->user()->isPatient())
                    Dr. {{ $conversation->doctor->user->name }}
                @else
                    {{ $conversation->patient->name }}
                @endif
            </h2>
            <div class="flex space-x-2">
                <button onclick="initiateCall('voice')" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Voice Call
                </button>
                <button onclick="initiateCall('video')" 
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
            <div id="callModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-90 z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 max-w-4xl w-full mx-4">
                    <div class="relative">
                        <!-- Video containers -->
                        <div id="videoContainer" class="hidden">
                            <video id="remoteVideo" class="w-full h-96 bg-gray-900 rounded-lg" autoplay playsinline></video>
                            <video id="localVideo" class="absolute bottom-4 right-4 w-48 h-36 bg-gray-800 rounded-lg" autoplay muted playsinline></video>
                        </div>
                        
                        <!-- Voice call UI -->
                        <div id="voiceContainer" class="hidden text-center py-12">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-100 mb-4">
                                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <h3 id="callStatus" class="text-xl font-semibold text-gray-900 mb-2">Memanggil...</h3>
                            <p id="callDuration" class="text-gray-600">00:00</p>
                        </div>

                        <!-- Call controls -->
                        <div class="flex justify-center space-x-4 mt-4">
                            <button id="toggleMicrophone" class="p-4 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                            </button>
                            <button id="toggleCamera" class="hidden p-4 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                            <button onclick="endCall()" class="p-4 rounded-full bg-red-600 hover:bg-red-700 transition">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Container -->
            <div class="bg-white shadow-sm sm:rounded-lg flex flex-col" style="height: calc(100vh - 200px);">
                <!-- Messages Area -->
                <div id="messagesArea" class="flex-1 overflow-y-auto p-6 space-y-4">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md">
                                @if($message->type === 'text')
                                    <div class="rounded-lg p-3 {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                                        <p class="text-sm">{{ $message->message }}</p>
                                    </div>
                                @elseif($message->type === 'voice_call' || $message->type === 'video_call')
                                    <div class="rounded-lg p-3 bg-gray-100 border border-gray-300">
                                        <div class="flex items-center space-x-2 text-sm text-gray-700">
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
                                <p class="text-xs text-gray-500 mt-1 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 p-4">
                    <form id="messageForm" class="flex space-x-4">
                        @csrf
                        <input type="text" 
                               id="messageInput" 
                               name="message" 
                               placeholder="Ketik pesan..."
                               class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
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

    @push('scripts')
    <script>
        const conversationId = {{ $conversation->id }};
        let localStream = null;
        let peerConnection = null;
        let currentCallSession = null;
        let callDurationInterval = null;

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
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();
            
            if (!message) return;

            try {
                const response = await fetch(`{{ auth()->user()->isDoctor() ? route('doctor.chat.send', $conversation) : route('chat.send', $conversation) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();
                
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
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Gagal mengirim pesan');
            }
        });

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Initiate Call
        async function initiateCall(type) {
            try {
                // Request permission first
                const constraints = {
                    audio: true,
                    video: type === 'video'
                };

                try {
                    localStream = await navigator.mediaDevices.getUserMedia(constraints);
                } catch (mediaError) {
                    alert('Tidak dapat mengakses ' + (type === 'video' ? 'kamera/mikrofon' : 'mikrofon') + '. Pastikan Anda memberikan izin akses.');
                    console.error('Media error:', mediaError);
                    return;
                }

                const response = await fetch(`/calls/conversations/${conversationId}/initiate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ type })
                });

                const data = await response.json();
                
                if (!data.success) {
                    alert('Gagal memulai panggilan: ' + (data.error || 'Unknown error'));
                    if (localStream) {
                        localStream.getTracks().forEach(track => track.stop());
                    }
                    return;
                }
                
                currentCallSession = data.call_session;

                // Show call modal
                document.getElementById('callModal').classList.remove('hidden');
                
                if (type === 'video') {
                    document.getElementById('videoContainer').classList.remove('hidden');
                    document.getElementById('voiceContainer').classList.add('hidden');
                    const localVideo = document.getElementById('localVideo');
                    localVideo.srcObject = localStream;
                    document.getElementById('toggleCamera').classList.remove('hidden');
                    
                    // Simulate remote video (in production, this would be the actual remote stream)
                    const remoteVideo = document.getElementById('remoteVideo');
                    remoteVideo.srcObject = localStream; // Demo: show own video
                } else {
                    document.getElementById('voiceContainer').classList.remove('hidden');
                    document.getElementById('videoContainer').classList.add('hidden');
                    document.getElementById('toggleCamera').classList.add('hidden');
                }

                // Update call status
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
                
            } catch (error) {
                console.error('Error initiating call:', error);
                alert('Gagal memulai panggilan: ' + error.message);
                if (localStream) {
                    localStream.getTracks().forEach(track => track.stop());
                }
            }
        }

        function setupPeerConnection() {
            // Simplified for demo - in production you'd implement full WebRTC signaling
            console.log('Call session established');
        }

        // End Call
        async function endCall() {
            try {
                if (currentCallSession) {
                    await fetch(`/calls/sessions/${currentCallSession.id}/end`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                }

                // Stop all tracks
                if (localStream) {
                    localStream.getTracks().forEach(track => track.stop());
                    localStream = null;
                }

                // Close peer connection
                if (peerConnection) {
                    peerConnection.close();
                    peerConnection = null;
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

                // Reset current session
                currentCallSession = null;

                // Show success message
                alert('Panggilan selesai');
                
                // Reload to show call history
                location.reload();
            } catch (error) {
                console.error('Error ending call:', error);
                // Still cleanup even if request fails
                if (localStream) {
                    localStream.getTracks().forEach(track => track.stop());
                }
                document.getElementById('callModal').classList.add('hidden');
                if (callDurationInterval) {
                    clearInterval(callDurationInterval);
                }
            }
        }

        // Toggle microphone
        document.getElementById('toggleMicrophone').addEventListener('click', () => {
            if (localStream) {
                const audioTrack = localStream.getAudioTracks()[0];
                audioTrack.enabled = !audioTrack.enabled;
                document.getElementById('toggleMicrophone').classList.toggle('bg-red-600');
                document.getElementById('toggleMicrophone').classList.toggle('bg-gray-200');
            }
        });

        // Toggle camera
        document.getElementById('toggleCamera').addEventListener('click', () => {
            if (localStream) {
                const videoTrack = localStream.getVideoTracks()[0];
                if (videoTrack) {
                    videoTrack.enabled = !videoTrack.enabled;
                    document.getElementById('toggleCamera').classList.toggle('bg-red-600');
                    document.getElementById('toggleCamera').classList.toggle('bg-gray-200');
                }
            }
        });

        // Auto scroll to bottom
        const messagesArea = document.getElementById('messagesArea');
        messagesArea.scrollTop = messagesArea.scrollHeight;
    </script>
    @endpush
</x-app-layout>
