<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $selected_conversation,$messages,$user,$auth_id,$event_name,$chat_page;
    // protected $listeners = ['load_doctor_conversation', 'load_patient_conversation', 'refreshData'];
    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_id = Auth::guard('patient')->user()->id;
        } else {
            $this->auth_id = Auth::guard('doctor')->user()->id;
        }
    }
    public function refreshData($message_id)
    {
        $newMessage = Message::findOrFail($message_id);
        $this->messages->push($newMessage);
    }
    public function broadcastMassage($event)
    { {
            $broadcastMessage = Message::find($event['message']);
            $broadcastMessage->read = 1;
            $this->refreshData($broadcastMessage->id);
        }

    }
    public function load_doctor_conversation(Conversation $conversation, Doctor $user)
    {
        $this->user=$user;
        $this->selected_conversation=$conversation;
        $this->messages = Message::where('conversation_id', $conversation->id)->get();
        // dd($this->messages);
    }
    public function load_patient_conversation(Conversation $conversation, Patient $user)
    {
        $this->user=$user;
        $this->selected_conversation=$conversation;
        $this->messages = Message::where('conversation_id', $conversation->id)->get();
        // dd($user);
    }


    public function getListeners()
    {
        if (Auth::guard('patient')->check()) {
            $auth_id = Auth::guard('patient')->user()->id;
            $this->event_name = "SentMessagePatient";
            $this->chat_page = "chat2";
        } else {
            $auth_id = Auth::guard('doctor')->user()->id;
            $this->event_name = "SentMessageDoctor";
            $this->chat_page = "chat";
        }

        return [
            "echo-private:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage', 'load_doctor_conversation', 'load_patient_conversation', 'refreshData'
        ];
    }
    public function render()
    {
        return view('dashboard.chats.chat-box');
    }
}
