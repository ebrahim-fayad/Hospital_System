<?php

namespace App\Livewire\Dashboard\Chats;

use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('dashboard.chats.main')->extends('Dashboard.layouts.master');
    }
}
