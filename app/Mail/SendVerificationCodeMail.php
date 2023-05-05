<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public function __construct($user)
    {
        $this->user =$user ;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Send Verification Code Mail',
        );
    }

    public function content()
    {
        return new Content(
            view: 'Mails.verify_email',
            with: $this->user ,
        );
    }

    public function attachments()
    {
        return [];
    }
}
