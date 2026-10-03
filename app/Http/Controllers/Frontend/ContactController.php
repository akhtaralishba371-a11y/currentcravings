<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ContactMessage;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $cms = SiteContent::allKeyed();
        return view('website.contact', compact('cms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'topic' => 'required|string|max:100',
            'message' => 'required|string|min:10|max:5000',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['topic'],
            'topic' => $validated['topic'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        $successMessage = SiteContent::get('contact_success_message', 'Your message has been sent! We\'ll get back to you within 24 hours.');
        return redirect()->back()->with('success', $successMessage);
    }
}
