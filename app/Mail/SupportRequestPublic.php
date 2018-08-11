<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportRequestPublic extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($summary, $email)
    {
        $this->summary = $summary;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Support Request")
                    ->view('emails.support-public-admin')
                    ->with([
                        'summary' => $this->summary,
                        'email' => $this->email,
                    ]);
    }
}
