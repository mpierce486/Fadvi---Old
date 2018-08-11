<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvisorAdded extends Mailable
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
        return $this->subject("You Have Been Added!")
                    ->view('emails.added-to-directory-advisor')
                    ->with([
                        'advisor' => $this->advisor,
                        'randomKey' => $this->randomKey,
                    ]);
    }
}
