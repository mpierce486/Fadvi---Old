<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdvisorAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($advisor, $randomKey)
    {
        $this->advisor = $advisor;
        $this->randomKey = $randomKey;
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
                    ->subject('You Have Been Added to the Fadvi Network!')
                    ->greeting('Hello '. $this->advisor->first_name . ',')
                    ->line('You have been added as an advisor to the Fadvi Advisor Network.')
                    ->line('Fadvi was created with the mission of making advice more accessible to those that seek it. Our users will be posting questions and, if you meet the criteria, you will be notified and have the ability to respond and engage with that user.')
                    ->line('To get started, please click the button below to register on the website to view any available questions.')
                    ->action('Register', url('/register/advisor/'. $this->randomKey));
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
