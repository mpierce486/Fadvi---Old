<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeAdvisor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advisor)
    {
        $this->advisor = $advisor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Welcome to Fadvi")
                    ->view('emails.welcome-advisor')
                    ->with([
                        'advisor' => $this->advisor,
                    ]);
    }
}
