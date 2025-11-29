<?php

namespace App\Http\Controllers;

use App\Models\CallSession;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Initiate a call
     */
    public function initiate(Request $request, Conversation $conversation)
    {
        try {
            $request->validate([
                'type' => 'required|in:voice,video',
            ]);

            // Check if user is part of the conversation
            if (!$this->userBelongsToConversation($conversation)) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
            }

            // Determine receiver
            $receiverId = $conversation->patient_id === auth()->id() 
                ? $conversation->doctor->user_id 
                : $conversation->patient_id;

            // Create call session
            $callSession = CallSession::create([
                'conversation_id' => $conversation->id,
                'caller_id' => auth()->id(),
                'receiver_id' => $receiverId,
                'type' => $request->type,
                'status' => 'ringing',
                'started_at' => now(),
            ]);

            // Create message record
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => auth()->id(),
                'type' => $request->type . '_call',
                'message' => 'Call initiated',
                'metadata' => ['call_session_id' => $callSession->id]
            ]);

            return response()->json([
                'success' => true,
                'call_session' => $callSession
            ]);
        } catch (\Exception $e) {
            \Log::error('Call initiate error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Answer a call
     */
    public function answer(Request $request, CallSession $callSession)
    {
        if (!$this->userBelongsToCallSession($callSession)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $callSession->update([
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'call_session' => $callSession
        ]);
    }

    /**
     * End a call
     */
    public function end(Request $request, CallSession $callSession)
    {
        try {
            if (!$this->userBelongsToCallSession($callSession)) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
            }

            $endedAt = now();
            $duration = $callSession->started_at ? $callSession->started_at->diffInSeconds($endedAt) : 0;

            $callSession->update([
                'status' => 'ended',
                'ended_at' => $endedAt,
                'duration_seconds' => $duration,
            ]);

            // Update message with duration
            Message::where('metadata->call_session_id', $callSession->id)
                ->update([
                    'metadata' => json_encode(['call_session_id' => $callSession->id, 'duration' => $duration])
                ]);

            return response()->json([
                'success' => true,
                'duration' => $duration
            ]);
        } catch (\Exception $e) {
            \Log::error('Call end error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get call session
     */
    public function show(CallSession $callSession)
    {
        if (!$this->userBelongsToCallSession($callSession)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($callSession);
    }

    /**
     * Check if user belongs to conversation
     */
    private function userBelongsToConversation(Conversation $conversation)
    {
        return $conversation->patient_id === auth()->id() 
            || $conversation->doctor->user_id === auth()->id();
    }

    /**
     * Check if user belongs to call session
     */
    private function userBelongsToCallSession(CallSession $callSession)
    {
        $conversation = $callSession->conversation;
        return $this->userBelongsToConversation($conversation);
    }

    /**
     * Handle WebRTC signaling
     */
    public function signal(Request $request, CallSession $callSession)
    {
        $request->validate([
            'type' => 'required|in:offer,answer,ice-candidate',
            'data' => 'required'
        ]);

        // In a production app, you would use WebSocket or Pusher
        // For now, we'll store the signal data temporarily
        
        return response()->json(['success' => true]);
    }
}
