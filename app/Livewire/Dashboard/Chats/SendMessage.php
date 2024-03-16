<?php

namespace App\Livewire\Dashboard\Chats;

use App\Events\SentMessageDoctor;
use App\Events\SentMessagePatient;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SendMessage extends Component
{
    public $selected_conversation, $message, $user, $sender;
    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->sender = Auth::guard('patient')->user();
        } else {
            $this->sender = Auth::guard('doctor')->user();
        }
    }
    #[Validate('required', message: 'لا يمكن ارسال رسالة فارغة')]
    public $body;
    protected $listeners = ['updateMessageDoctor', 'updateMessagePatient', 'dispatchSentMessageDoctor'];
    // public function mount()
    // {
    //     $this->user=auth()->user()->email;
    // }
    public function updateMessageDoctor(Conversation $conversation, Doctor $user)
    {
        $this->selected_conversation = $conversation;
        $this->user = $user;
    }
    public function updateMessagePatient(Conversation $conversation, Patient $user)
    {
        $this->selected_conversation = $conversation;
        $this->user = $user;
    }
    public function createMessage()
    {
        $this->validate();
        $this->message =  Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' => auth()->user()->email,
            'receiver_email' => $this->user->email,
            'body' => $this->body,
        ]);
        $this->selected_conversation->update([
            'last_time_message'
            => $this->message->created_at
        ]);
        $this->reset('body');
        $this->dispatch('refreshData', message_id: $this->message->id)->to(ChatBox::class);
        $this->dispatch('refreshData')->to(ChatList::class);
        $this->dispatch('dispatchSentMessageDoctor')->self();
        // $this->redirect(ChatBox::class);
        // dd($this->body);
    }
    public function dispatchSentMessageDoctor()
    {
        // dd($this->selected_conversation);
        if ((Auth::guard('patient')->check())) {
            broadcast(new SentMessageDoctor(
                $this->sender,
                $this->message,
                $this->user,
                $this->selected_conversation

            ));
        } else {
            broadcast(new SentMessagePatient(
                $this->sender,
                $this->message,
                $this->user,
                $this->selected_conversation

            ));
        }

    }
    public function render()
    {
        return view('dashboard.chats.send-message');
    }
}
