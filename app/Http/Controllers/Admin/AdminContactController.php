<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by subject
        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');
            });
        }

        $messages = $query->latest()->paginate(15);

        // Get statistics
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'read' => ContactMessage::read()->count(),
            'replied' => ContactMessage::replied()->count(),
            'today' => ContactMessage::whereDate('created_at', today())->count(),
            'this_week' => ContactMessage::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return view('admin.contacts.index', compact('messages', 'stats'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contact)
    {
        // Mark as read if unread
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Update the message status and add notes.
     */
    public function update(Request $request, ContactMessage $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
            'admin_notes' => 'nullable|string',
        ]);

        $updateData = $validated;

        if ($validated['status'] === 'replied' && $contact->status !== 'replied') {
            $updateData['replied_at'] = now();
            $updateData['replied_by'] = auth()->id();
        }

        $contact->update($updateData);

        return redirect()->back()
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    /**
     * Bulk action on messages
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_replied,archive,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:contact_messages,id',
        ]);

        $messages = ContactMessage::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'mark_read':
                $messages->update(['status' => 'read']);
                $message = 'Pesan berhasil ditandai sudah dibaca.';
                break;
            case 'mark_replied':
                $messages->update([
                    'status' => 'replied',
                    'replied_at' => now(),
                    'replied_by' => auth()->id(),
                ]);
                $message = 'Pesan berhasil ditandai sudah dibalas.';
                break;
            case 'archive':
                $messages->update(['status' => 'archived']);
                $message = 'Pesan berhasil diarsipkan.';
                break;
            case 'delete':
                $messages->delete();
                $message = 'Pesan berhasil dihapus.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}
