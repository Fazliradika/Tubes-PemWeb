<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of the FAQs.
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        $faqs = $query->ordered()->paginate(15);

        // Get statistics
        $stats = [
            'total' => Faq::count(),
            'active' => Faq::active()->count(),
            'inactive' => Faq::where('is_active', false)->count(),
            'categories' => Faq::selectRaw('category, COUNT(*) as count')->groupBy('category')->pluck('count', 'category'),
        ];

        return view('admin.faqs.index', compact('faqs', 'stats'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|in:general,appointment,payment,technical,account,other',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|in:general,appointment,payment,technical,account,other',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * Toggle the active status of a FAQ.
     */
    public function toggleStatus(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);

        return redirect()->back()
            ->with('success', 'Status FAQ berhasil diubah.');
    }

    /**
     * Reorder FAQs
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:faqs,id',
            'orders.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $item) {
            Faq::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
