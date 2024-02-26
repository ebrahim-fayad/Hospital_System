<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccountTranslation extends Model
{
    use HasFactory;
    public $fillable = ['description'];
    public $timestamps = false;
}
