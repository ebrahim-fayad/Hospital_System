<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateGroupInvoice extends Notification
{
    use Queueable;

    private $serviceName, $service_id;
    public function __construct($serviceName, $service_id)
    {
        $this->serviceName = $serviceName;
        $this->service_id = $service_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'service_id' => $this->service_id,
            'serviceName' => $this->serviceName,
            'message' => 'تمت اضافة مجموعة من الخدمات باسم :',
        ];
    }
}
