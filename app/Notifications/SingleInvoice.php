<?php

namespace App\Notifications;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SingleInvoice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $patient, $service_id, $doctor_id;
    public function __construct($data)
    {
        $patient = Patient::find($data['patient']);
        $this->patient = $patient->name;
        $this->doctor_id = $data['doctor_id'];
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
            'doctor_id' =>  $this->doctor_id,
            'patient' => $this->patient,
            'message' => 'كشف جديد باسم :',
        ];
    }
}
