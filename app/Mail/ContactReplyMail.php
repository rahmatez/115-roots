<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactMessage $contactMessage,
        public string $replyBody
    ) {}

    public function build()
    {
        return $this->subject('Re: ' . $this->contactMessage->subject)
            ->markdown('emails.contact_reply');
    }
}
