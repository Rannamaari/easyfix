<?php

namespace App\Mail;

use App\Enums\JobStatus;
use App\Models\JobRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobStatusChanged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobRequest $job,
        public JobStatus $status,
        public ?string $note = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Job #{$this->job->id} - {$this->status->label()}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job-status-changed',
        );
    }
}
