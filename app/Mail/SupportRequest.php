<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($summary, $user)
    {
        $this->summary = $summary;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Support Request")
                    ->view('emails.support-admin')
                    ->with([
                        'summary' => $this->summary,
                        'user' => $this->user,
                    ]);
    }
}
