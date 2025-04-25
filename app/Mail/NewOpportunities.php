<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewOpportunities extends Mailable
{
    use Queueable, SerializesModels;

    private const OPPORTUNITIES_TO_SHOW = 5;

    public function __construct(public Collection $jobs)
    {
        $this->jobs = $this->jobs->take(self::OPPORTUNITIES_TO_SHOW);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Recommended Job Opportunities',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-opportunities',
        );
    }
}
