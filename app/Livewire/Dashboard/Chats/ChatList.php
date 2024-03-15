<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;

class ChatList extends Component
{
    public $user;
    public function mount()
    {
        $this->user=auth()->user()->email;
    }
    // public function getUsersName($conversation)
    // {
    //     if ($conversation->sender_email == $this->user) {
    //         return Doctor::Where('email', $conversation->sender_email)->orWhere('email',$conversation->receiver_email)->first()->name;
    //     }
    //     else {
    //         return Patient::firstWhere('email', $conversation->receiver_email)->name;
    //     }
    // }
    public function getPatientName($conversation)
    {
        return Patient::Where('email', $conversation->sender_email)->orWhere('email', $conversation->receiver_email)->first()->name;
    }
    public function getDoctorName($conversation)
    {
        return Doctor::Where('email', $conversation->sender_email)->orWhere('email', $conversation->receiver_email)->first()->name;
    }
    public function render()
    {

        return view('dashboard.chats.chat-list',[
            'conversations'=>Conversation::where('sender_email',$this->user)->orWhere('receiver_email', $this->user)->latest()->get(),
        ]);
    }
}
