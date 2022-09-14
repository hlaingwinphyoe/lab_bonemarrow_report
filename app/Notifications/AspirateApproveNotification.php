<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AspirateApproveNotification extends Notification
{
    use Queueable;
    public $aspirate;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($aspirate)
    {
        $this->aspirate = $aspirate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'aspirate_id' => $this->aspirate->id,
            'name' => $this->aspirate->patient_name,
            'description' => ' report အား အတည်ပြုပြီးဖြစ်ပါသည်။ (Aspirate)',
        ];
    }
}
