<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BillEmail extends Mailable
{


    public $billData;
    public $imagePath;

    /**
     * Create a new message instance.
     */
    public function __construct($billData, $imagePath)
    {
        $this->billData = $billData;
        $this->imagePath = $imagePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Bill Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.bill',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->imagePath && file_exists(public_path($this->imagePath))) {
            $attachments[] = Attachment::fromPath(public_path($this->imagePath));
        }

        return $attachments;
    }
}
