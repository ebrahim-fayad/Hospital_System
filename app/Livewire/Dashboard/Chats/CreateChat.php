<?php

namespace App\Livewire\Dashboard\Chats;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public $auth_email;

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }
    public function createConversation($receiver_email)
    {

        $check_Conversation = Conversation::CheckConversation($this->auth_email, $receiver_email)->get();
        if ($check_Conversation->isEmpty()) {
            DB::beginTransaction();
            try {
                // $createConversation
                $createConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => null,
                ]);
                // create message
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'السلام عليكم',
                ]);
                DB::commit();
                $this->emitSelf('render');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {

            dd('Conversation yes');
        }

    }

    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $this->users = Doctor::all();
        } else {
            $this->users = Patient::all();
        }
        return view('dashboard.chats.create-chat')->extends('Dashboard.layouts.master');
    }
}
