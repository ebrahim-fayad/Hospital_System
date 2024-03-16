<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SendMessage extends Component
{
    public $selected_conversation, $user;
    #[Validate('required',message:'لا يمكن ارسال رسالة فارغة')]
    public $body;
    protected $listeners = ['updateMessageDoctor', 'updateMessagePatient'];
    // public function mount()
    // {
    //     $this->user=auth()->user()->email;
    // }
    public function updateMessageDoctor(Conversation $conversation, Doctor $user)
    {
        $this->selected_conversation = $conversation;
        $this->user=$user;
    }
    public function updateMessagePatient(Conversation $conversation, Patient $user)
    {
        $this->selected_conversation = $conversation;
        $this->user=$user;
    }
    public function createMessage()
    {
        $this->validate();
      $message=  Message::create([
            'conversation_id'=>$this->selected_conversation->id,
            'sender_email'=>auth()->user()->email,
            'receiver_email'=>$this->user->email,
            'body'=>$this->body,
        ]);
        $this->selected_conversation->update([
            'last_time_message'=>$message->created_at
        ]);
        $this->reset('body');
        $this->dispatch('refreshData',message_id:$message->id)->to(ChatBox::class);
        $this->dispatch('refreshData')->to(ChatList::class);
        // $this->redirect(ChatBox::class);
        // dd($this->body);
    }
    public function render()
    {
        return view('dashboard.chats.send-message');
    }
}
