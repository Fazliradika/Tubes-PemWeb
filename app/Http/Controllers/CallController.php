<?php

namespace App\Http\Controllers;

use App\Models\CallSession;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CallController extends Controller
{
    /**
     * Initiate a video call (Google Meet dummy link)
     */
    public function initiate(Request $request, Conversation $conversation)
    {
        try {
            $request->validate([
                'type' => 'required|in:video',
            ]);

            // Check if user is part of the conversation
            if (!$this->userBelongsToConversation($conversation)) {
                return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
            }

            // Determine receiver
            $receiverId = $conversation->patient_id === auth()->id() 
                ? $conversation->doctor->user_id 
                : $conversation->patient_id;

            $meetLink = $this->generateDummyMeetLink();

            // Create call session
            $callSession = CallSession::create([
                'conversation_id' => $conversation->id,
                'caller_id' => auth()->id(),
                'receiver_id' => $receiverId,
                'type' => 'video',
                'status' => 'ended',
                'started_at' => now(),
                'ended_at' => now(),
                'duration_seconds' => 0,
            ]);

            // Create message record
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => auth()->id(),
                'type' => 'video_call',
                'message' => 'Google Meet',
                'metadata' => [
                    'call_session_id' => $callSession->id,
                    'meet_link' => $meetLink,
                ],
            ]);

            $conversation->update(['last_message_at' => now()]);

            return response()->json([
                'success' => true,
                'call_session' => $callSession,
                'meet_link' => $meetLink,
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

    private function generateDummyMeetLink(): string
    {
        $part1 = Str::lower(Str::random(3));
        $part2 = Str::lower(Str::random(4));
        $part3 = Str::lower(Str::random(3));
        return "https://meet.google.com/{$part1}-{$part2}-{$part3}";
    }
}
