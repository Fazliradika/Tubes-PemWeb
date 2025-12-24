<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the public FAQ page with FAQs from database.
     */
    public function index()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('category')
            ->orderBy('order')
            ->orderBy('created_at')
            ->get();

        return view('pages.faq', compact('faqs'));
    }
}
