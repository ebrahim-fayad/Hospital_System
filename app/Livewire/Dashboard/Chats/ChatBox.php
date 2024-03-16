<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;

class ChatBox extends Component
{
    public $selected_conversation,$messages,$user;
    protected $listeners = ['load_doctor_conversation', 'load_patient_conversation', 'refreshData'];
    public function refreshData($message_id)
    {
        $newMessage = Message::findOrFail($message_id);
        $this->messages->push($newMessage);
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
    public function render()
    {
        return view('dashboard.chats.chat-box');
    }
}
