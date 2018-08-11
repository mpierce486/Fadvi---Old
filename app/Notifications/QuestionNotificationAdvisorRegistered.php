<?php

namespace Fadvi\Notifications;

use Fadvi\User;
use Fadvi\Question;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuestionNotificationAdvisorRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct ($userAdvisor, $question, $topic)
    {
        $this->userAdvisor = $userAdvisor;
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
                    ->subject('New Question is Available')
                    ->greeting('Hello '. $this->userAdvisor->first_name . ',')
                    ->line('A new question has been posted that you may be able to help with. You can respond by going to your profile after logging in.')
                    ->line('Question Topic: '. $this->topic->topic_name)
                    ->line('Question Details: '. $this->question->question)
                    ->action('Respond to Question', url('/profile/'.$this->userAdvisor->first_name . $this->userAdvisor->last_name));
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
