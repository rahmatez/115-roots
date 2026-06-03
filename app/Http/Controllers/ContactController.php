<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactMessage;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(ContactRequest $request)
    {
        $data = $request->validated();

        $message = ContactMessage::create($data + ['status' => ContactMessage::STATUS_NEW]);

        try {
            Mail::to(config('mail.from.address'))->send(new ContactMail($data));
        } catch (\Exception $e) {
            report($e);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.']);
        }

        return redirect()->back()->with('message', 'Pesan Anda berhasil terkirim!');
    }
}
