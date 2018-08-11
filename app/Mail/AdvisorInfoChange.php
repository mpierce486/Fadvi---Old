<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvisorInfoChange extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advisor, $summary)
    {
        $this->advisor = $advisor;
        $this->summary = $summary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Advisor Info Change Request")
                    ->view('emails.advisor-info-change')
                    ->with([
                        'advisor' => $this->advisor,
                        'summary' => $this->summary,
                    ]);
    }
}
