<?php

namespace App\Mail;

use App\Models\JobRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobRequest $job,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Job Request Confirmed - #{$this->job->id}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job-confirmation',
        );
    }
}
