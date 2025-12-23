<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact page
     */
    public function show()
    {
        return view('pages.contact');
    }

    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|in:general,appointment,payment,technical,complaint,other',
            'message' => 'required|string|min:10|max:5000',
        ]);

        $validated['status'] = 'unread';

        ContactMessage::create($validated);

        return redirect()->back()
            ->with('success', 'Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
