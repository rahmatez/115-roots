<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::newest()->paginate(15);

        return view('admin.contact_messages.index', compact('messages'));
    }

    public function show(ContactMessage $contact_message)
    {
        $contact_message->markAsRead();

        return view('admin.contact_messages.show', ['message' => $contact_message]);
    }

    public function update(Request $request, ContactMessage $contact_message)
    {
        $request->validate([
            'status' => ['required', 'in:new,read,replied'],
        ]);

        $contact_message->update(['status' => $request->status]);

        return redirect()->route('admin.contact_messages.show', $contact_message)->with([
            'message' => 'Status updated!',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(ContactMessage $contact_message)
    {
        $contact_message->delete();

        return redirect()->route('admin.contact_messages.index')->with([
            'message' => 'Message deleted!',
            'alert-type' => 'danger',
        ]);
    }
}
