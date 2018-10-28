<?php

namespace Fadvi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeAdvisor extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->subject('Welcome To Fadvi')
                    ->greeting('Hello '. $this->advisor->first_name . ',')
                    ->line('Fadvi was created with the mission to help individuals find advice for their finances, taxes, and estate planning. As an advisor, you play a critical role in helping your clients achieve their goals.')
                    ->line('Now that you are registered, from your profile you will be able to see any available questions to respond to as well as track you conversations with other users.');
                    ->line('Thank you for registering and please let us know if there is anything we can improve on the platform for you!');
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
