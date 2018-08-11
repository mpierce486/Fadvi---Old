<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionNotificationAdvisor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $advisor, $discussionId, $post)
    {
        $this->user = $user;
        $this->advisor = $advisor;
        $this->discussionId = $discussionId;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Fadvi Discussion Notification")
                    ->view('emails.discussion-notification-advisor')
                    ->with([
                        'user' => $this->user,
                        'advisor' => $this->advisor,
                        'discussionId' => $this->discussionId,
                        'post' => $this->post,
                    ]);
    }
}
