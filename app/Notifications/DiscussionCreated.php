<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DiscussionCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($advisor, $discussion, $topic)
    {
        $this->advisor = $advisor;
        $this->discussion = $discussion;
        $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Discussion Requested')
                    ->greeting('Hello '. $this->advisor->first_name . ',')
                    ->line('A user wants to begin a discussion with you regarding your response about ' . $this->topic->topic_name . '.')
                    ->line('A discussion is a confidential way for you and a user to share information regarding a particular topic. Please keep in mind that no personally-identifiable information should be given or requested through a discussion. If you both feel it is appropriate, arrange communication outside of Fadvi to provide more personalized advice for this user.')
                    ->line('You may access this discussion through your profile or by clicking the button below.')
                    ->action('View Discussion', url('/discussion/'.$this->discussion->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
