<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateInvoice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $invoice_id;
    public $invoice_name;
    public $message;
    public $created_at;
    public function __construct($data)
    {
        $this->invoice_id = $data['invoice_id'];
        $this->invoice_name = $data['invoice_name'];
        $this->message = 'تمت اضافة مجموعة من الخدمات باسم :';
        $this->created_at = date('Y-m-d H:i:s');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        // return [
        //     new PrivateChannel('channel-name'),
        // ];
        return ['create-invoice'];
    }
}
