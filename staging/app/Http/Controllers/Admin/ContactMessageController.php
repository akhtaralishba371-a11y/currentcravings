<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latest('id')->paginate(20);

        return view('admin.contact_messages.index', compact('messages'));
    }

    public function show(ContactMessage $contact_message): View
    {
        return view('admin.contact_messages.show', ['message' => $contact_message]);
    }

    public function edit(ContactMessage $contact_message): View
    {
        return view('admin.contact_messages.edit', ['message' => $contact_message]);
    }

    public function update(Request $request, ContactMessage $contact_message): RedirectResponse
    {
        $request->validate([
            'additional_data_json' => ['nullable', 'string'],
        ]);
        $contact_message->is_read = $request->boolean('is_read');
        $raw = $request->input('additional_data_json', '');
        if (filled($raw)) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $contact_message->additional_data = $decoded;
            }
        }
        $contact_message->save();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message updated.');
    }

    public function destroy(ContactMessage $contact_message): RedirectResponse
    {
        $contact_message->delete();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted.');
    }
}
