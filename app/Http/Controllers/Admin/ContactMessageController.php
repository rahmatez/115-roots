<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ContactReplyMail;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function reply(Request $request, ContactMessage $contact_message)
    {
        $data = $request->validate([
            'reply_body' => ['required', 'string', 'max:5000'],
        ]);

        try {
            Mail::to($contact_message->email)->send(
                new ContactReplyMail($contact_message, $data['reply_body'])
            );
        } catch (\Exception $e) {
            report($e);

            return back()->with([
                'message' => 'Failed to send reply email. Please check mail configuration.',
                'alert-type' => 'danger',
            ]);
        }

        $contact_message->update([
            'admin_reply' => $data['reply_body'],
            'replied_at' => now(),
            'status' => ContactMessage::STATUS_REPLIED,
        ]);

        return redirect()->route('admin.contact_messages.show', $contact_message)->with([
            'message' => 'Reply sent successfully!',
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
