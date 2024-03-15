<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function scopeCheckConversation( $query,$auth_email,$receiver_email)
    {
        $query->where('sender_email', $auth_email)
            ->where('receiver_email', $receiver_email)->orWhere('receiver_email', $auth_email)->where('sender_email', $receiver_email);
    }

    public function Messages()
    {

        return $this->hasMany(Message::class);
    }
}
