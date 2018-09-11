<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DiscussionPostNotificationAdvisor extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $advisor, $discussion, $topic)
    {
        $this->user = $user;
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
                    ->subject('Fadvi Discussion')
                    ->greeting('Hello '. $this->advisor->first_name . ',')
                    ->line($this->user->first_name . ' just posted in your discussion about ' . $this->topic->topic_name . '. Access this discussion from your profile or by clicking the link below.')
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
