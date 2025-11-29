<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $candidate;
    public $pdfPath;

    public function __construct($candidate, $pdfPath = null)
    {
        $this->candidate = $candidate;
        $this->pdfPath = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Status Pendaftaran - Sekolah Cinta Kasih Tzu Chi',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status_update',
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if ($this->pdfPath) {
            $attachments[] = Attachment::fromPath($this->pdfPath);
        }

        if ($this->candidate->profile && $this->candidate->profile->profile_picture) {
             $attachments[] = Attachment::fromPath(storage_path('app/public/' . $this->candidate->profile->profile_picture))
                ->as('profile.jpg')
                ->withMime('image/jpeg');
        }

        return $attachments;
    }
}
