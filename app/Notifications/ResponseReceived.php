<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResponseReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $response, $question, $topic)
    {
        $this->user = $user;
        $this->response = $response;
        $this->question = $question;
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
                    ->subject('Fadvi Response Received')
                    ->greeting('Hello '. $this->user->first_name . ',')
                    ->line('An advisor has responded to your question about '.$this->topic.'. Click the button below to view this response in your profile.')
                    ->line('If you like this response or want more detail consider inviting this advisor to a discussion. A discussion is similar to a private chatroom where you and the advisor can discuss more details relating to your question. We still keep your information confidential and remind you to only give information relevant to the discussion. If you want to engage the advisor more directly, you can contact the advisor offline.')
                    ->action('View Response', url('/profile/'.$this->user->first_name . $this->user->last_name));
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
