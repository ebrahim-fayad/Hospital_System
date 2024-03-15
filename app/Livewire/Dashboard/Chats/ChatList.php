<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    public $user;

    // public function getUsersName($conversation)
    // {
    //     if ($conversation->sender_email == $this->user) {
    //         return Doctor::Where('email', $conversation->sender_email)->orWhere('email',$conversation->receiver_email)->first()->name;
    //     }
    //     else {
    //         return Patient::firstWhere('email', $conversation->receiver_email)->name;
    //     }
    // }
    public function getPatientName($conversation, $request)
    {
        return Patient::Where('email', $conversation->sender_email)->orWhere('email', $conversation->receiver_email)->first()->$request;
    }
    public function getDoctorName($conversation, $request)
    {
        return Doctor::Where('email', $conversation->sender_email)->orWhere('email', $conversation->receiver_email)->first()->$request;
    }
    public function test($conversation, $id)
    {
        if (Auth::guard('patient')->check()) {
            $this->user  = Doctor::findOrFail($id);
            $this->dispatch('load_doctor_conversation', conversation: $conversation, user: $this->user)->to(ChatBox::class);
        } else {
            $this->user  = Patient::findOrFail($id);
            $this->dispatch('load_patient_conversation', conversation: $conversation, user: $this->user)->to(ChatBox::class);
        }
    }
    public function render()
    {

        return view('dashboard.chats.chat-list', [
            'conversations' => Conversation::where('sender_email', auth()->user()->email)->orWhere('receiver_email', auth()->user()->email)->latest()->get(),
        ]);
    }
}
