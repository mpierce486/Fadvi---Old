<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvisorRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advisor, $randomKey)
    {
        $this->advisor = $advisor;
        $this->randomKey = $randomKey;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Fadvi Registration")
                    ->view('emails.advisorregister')
                    ->with([
                        'advisor' => $this->advisor,
                        'randomKey' => $this->randomKey,
                    ]);
    }
}
