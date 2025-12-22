<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\CallSession;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display all conversations for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isPatient()) {
            $conversations = Conversation::with(['doctor.user', 'latestMessage'])
                ->where('patient_id', $user->id)
                ->active()
                ->latest('last_message_at')
                ->paginate(20);
        } elseif ($user->isDoctor()) {
            $doctor = $user->doctorProfile;
            $conversations = Conversation::with(['patient', 'latestMessage'])
                ->where('doctor_id', $doctor->id)
                ->active()
                ->latest('last_message_at')
                ->paginate(20);
        } else {
            abort(403);
        }

        return view('chat.index', compact('conversations'));
    }

    /**
     * Show specific conversation
     */
    public function show(Conversation $conversation)
    {
        $user = Auth::user();
        
        // Authorization check
        if ($user->isPatient() && $conversation->patient_id !== $user->id) {
            abort(403);
        } elseif ($user->isDoctor() && $conversation->doctor->user_id !== $user->id) {
            abort(403);
        }

        $conversation->load(['appointment', 'patient', 'doctor.user']);
        $messages = $conversation->messages()->with('sender')->get();

        // Mark messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.show', compact('conversation', 'messages'));
    }

    /**
     * Create or get conversation from appointment
     */
    public function createFromAppointment(Appointment $appointment)
    {
        $user = Auth::user();
        
        // Check authorization
        if (!$user->isPatient() || $appointment->patient_id !== $user->id) {
            abort(403);
        }

        // Check if appointment is confirmed
        if ($appointment->status !== 'confirmed' && $appointment->status !== 'completed') {
            return back()->with('error', 'Anda hanya bisa chat dengan dokter setelah appointment dikonfirmasi');
        }

        // Get or create conversation
        $conversation = Conversation::firstOrCreate(
            [
                'appointment_id' => $appointment->id,
            ],
            [
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'status' => 'active',
                'last_message_at' => now(),
            ]
        );
        
        // Update last_message_at if conversation already exists but is null
        if (!$conversation->last_message_at) {
            $conversation->update(['last_message_at' => now()]);
        }

        return redirect()->route('chat.show', $conversation);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request, Conversation $conversation)
    {
        $user = Auth::user();
        
        // Authorization check
        if ($user->isPatient() && $conversation->patient_id !== $user->id) {
            abort(403);
        } elseif ($user->isDoctor() && $conversation->doctor->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required_without:type|string',
            'type' => 'nullable|in:text,image,file',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => $validated['message'] ?? null,
            'type' => $validated['type'] ?? 'text',
        ]);

        // Update conversation last message time
        $conversation->update(['last_message_at' => now()]);

        // Always return JSON for AJAX requests
        return response()->json([
            'success' => true,
            'message' => $message->load('sender'),
        ]);
    }

    /**
     * Fetch new messages after a given message id (simple polling for realtime-like UX)
     */
    public function fetchMessages(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        // Authorization check
        if ($user->isPatient() && $conversation->patient_id !== $user->id) {
            abort(403);
        } elseif ($user->isDoctor() && $conversation->doctor->user_id !== $user->id) {
            abort(403);
        }

        $afterId = (int) $request->query('after_id', 0);

        $messages = $conversation->messages()
            ->with('sender')
            ->when($afterId > 0, fn($q) => $q->where('id', '>', $afterId))
            ->orderBy('id')
            ->limit(100)
            ->get();

        // Mark unread messages as read (user is currently viewing this conversation)
        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    /**
     * Initiate a call
     */
    public function initiateCall(Request $request, Conversation $conversation)
    {
        $user = Auth::user();
        
        // Authorization check
        if ($user->isPatient() && $conversation->patient_id !== $user->id) {
            abort(403);
        } elseif ($user->isDoctor() && $conversation->doctor->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|in:voice,video',
        ]);

        // Determine receiver
        $receiverId = $user->isPatient() 
            ? $conversation->doctor->user_id 
            : $conversation->patient_id;

        $callSession = CallSession::create([
            'conversation_id' => $conversation->id,
            'caller_id' => $user->id,
            'receiver_id' => $receiverId,
            'type' => $validated['type'],
            'status' => 'calling',
        ]);

        // Create system message for call
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'type' => $validated['type'] === 'voice' ? 'voice_call' : 'video_call',
            'metadata' => [
                'call_session_id' => $callSession->id,
                'status' => 'calling',
            ],
        ]);

        return response()->json([
            'success' => true,
            'call_session' => $callSession,
        ]);
    }

    /**
     * Answer a call
     */
    public function answerCall(CallSession $callSession)
    {
        $user = Auth::user();
        
        if ($callSession->receiver_id !== $user->id) {
            abort(403);
        }

        $callSession->update([
            'status' => 'ongoing',
            'started_at' => now(),
        ]);

        // Update message metadata
        Message::where('metadata->call_session_id', $callSession->id)
            ->update([
                'metadata' => [
                    'call_session_id' => $callSession->id,
                    'status' => 'ongoing',
                ],
            ]);

        return response()->json([
            'success' => true,
            'call_session' => $callSession,
        ]);
    }

    /**
     * End a call
     */
    public function endCall(CallSession $callSession)
    {
        $user = Auth::user();
        
        if ($callSession->caller_id !== $user->id && $callSession->receiver_id !== $user->id) {
            abort(403);
        }

        $duration = $callSession->started_at 
            ? now()->diffInSeconds($callSession->started_at) 
            : 0;

        $callSession->update([
            'status' => 'ended',
            'ended_at' => now(),
            'duration_seconds' => $duration,
        ]);

        // Update message metadata
        Message::where('metadata->call_session_id', $callSession->id)
            ->update([
                'metadata' => [
                    'call_session_id' => $callSession->id,
                    'status' => 'ended',
                    'duration' => $duration,
                ],
            ]);

        return response()->json([
            'success' => true,
            'duration' => $duration,
        ]);
    }

    /**
     * Reject a call
     */
    public function rejectCall(CallSession $callSession)
    {
        $user = Auth::user();
        
        if ($callSession->receiver_id !== $user->id) {
            abort(403);
        }

        $callSession->update([
            'status' => 'rejected',
            'ended_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Get unread message count
     */
    public function unreadCount()
    {
        $user = Auth::user();
        
        if ($user->isPatient()) {
            $count = Message::whereHas('conversation', function ($query) use ($user) {
                $query->where('patient_id', $user->id);
            })
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->count();
        } elseif ($user->isDoctor()) {
            $doctor = $user->doctorProfile;
            $count = Message::whereHas('conversation', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->count();
        } else {
            $count = 0;
        }

        return response()->json(['count' => $count]);
    }
}
