<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BroadcastNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $htmlContent;
    public $email;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjectLine, $htmlContent, $subscriber = null)
    {
        $this->subjectLine = $subjectLine;
        $this->htmlContent = $htmlContent;
        if ($subscriber) {
            $this->email = $subscriber->email;
            $this->token = $subscriber->token;
        }
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.newsletter-broadcast',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
