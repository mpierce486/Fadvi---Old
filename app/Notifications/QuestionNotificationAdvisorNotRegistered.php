<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuestionNotificationAdvisorNotRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($advisor, $question, $topic, $advisorKey)
    {
        $this->advisor = $advisor;
        $this->question = $question;
        $this->topic = $topic;
        $this->advisorKey = $advisorKey;
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
                    ->subject('New Question is Available')
                    ->greeting('Hello '. $this->advisor->first_name . ',')
                    ->line('A new question has been posted that you may be able to help with. In order to respond, you will need to register online at Fadvi.com by clicking the button below.')
                    ->line('Once registered, you can view available questions to respond to from your profile page.')
                    ->line('Question Topic: '. $this->topic->topic_name)
                    ->line('Question Summary: '. $this->question->question)
                    ->action('Register', url('/register/advisor/'. $this->advisorKey->key));
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
