<?php

namespace Fadvi\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DiscussionNotificationUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advisor, $user, $discussionId, $post)
    {
        $this->advisor = $advisor;
        $this->user = $user;
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
                    ->view('emails.discussion-notification-user')
                    ->with([
                        'advisor' => $this->advisor,
                        'user' => $this->user,
                        'discussionId' => $this->discussionId,
                        'post' => $this->post,
                    ]);
    }
}
