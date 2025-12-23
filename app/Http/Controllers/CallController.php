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
     * Initiate a video call using Jitsi Meet
     */
    public function initiate(Request $request, Conversation $conversation)
    {
        try {
            $request->validate([
                'type' => 'required|in:video,voice',
            ]);

            // Eager load doctor to avoid N+1 and ensure data is available
            $conversation->load('doctor');

            // Check if user is part of the conversation
            if (!$this->userBelongsToConversation($conversation)) {
                return response()->json(['success' => false, 'error' => 'Unauthorized Access'], 403);
            }

            // Safety check for doctor relationship
            if (!$conversation->doctor) {
                return response()->json(['success' => false, 'error' => 'Doctor data not found'], 404);
            }

            // Determine receiver
            $receiverId = $conversation->patient_id === auth()->id()
                ? $conversation->doctor->user_id
                : $conversation->patient_id;

            // Generate unique Jitsi room name
            $roomName = $this->generateJitsiRoomName($conversation);
            $jitsiLink = "https://meet.jit.si/{$roomName}";

            // Create call session
            $callSession = CallSession::create([
                'conversation_id' => $conversation->id,
                'caller_id' => auth()->id(),
                'receiver_id' => $receiverId,
                'type' => $request->type,
                'status' => 'calling',
                'started_at' => now(),
            ]);

            // Create message record
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => auth()->id(),
                'type' => 'video_call',
                'message' => 'Video Call via Jitsi Meet',
                'metadata' => [
                    'call_session_id' => $callSession->id,
                    'jitsi_link' => $jitsiLink,
                    'room_name' => $roomName,
                ],
            ]);

            $conversation->update(['last_message_at' => now()]);

            return response()->json([
                'success' => true,
                'call_session' => $callSession,
                'jitsi_link' => $jitsiLink,
                'room_name' => $roomName,
                'message' => $message->load('sender'),
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
     * End a call session
     */
    public function end(CallSession $callSession)
    {
        if (!$this->userBelongsToCallSession($callSession)) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        $duration = $callSession->started_at
            ? now()->diffInSeconds($callSession->started_at)
            : 0;

        $callSession->update([
            'status' => 'ended',
            'ended_at' => now(),
            'duration_seconds' => $duration,
        ]);

        return response()->json([
            'success' => true,
            'duration' => $duration,
        ]);
    }

    /**
     * Check if user belongs to conversation
     */
    private function userBelongsToConversation(Conversation $conversation)
    {
        $userId = (int) auth()->id();

        // Safe check with type casting
        $isPatient = (int) $conversation->patient_id === $userId;

        // Check doctor side safely
        $conversation->loadMissing('doctor');
        $isDoctor = $conversation->doctor && (int) $conversation->doctor->user_id === $userId;

        return $isPatient || $isDoctor;
    }

    /**
     * Check if user belongs to call session
     */
    private function userBelongsToCallSession(CallSession $callSession)
    {
        $conversation = $callSession->conversation;
        if (!$conversation)
            return false;

        return $this->userBelongsToConversation($conversation);
    }

    /**
     * Generate unique Jitsi room name
     */
    private function generateJitsiRoomName(Conversation $conversation): string
    {
        $prefix = 'HealthFirst';
        $conversationId = $conversation->id;
        $timestamp = now()->format('YmdHis');
        $random = Str::lower(Str::random(6));

        return "{$prefix}-Consultation-{$conversationId}-{$timestamp}-{$random}";
    }
}
