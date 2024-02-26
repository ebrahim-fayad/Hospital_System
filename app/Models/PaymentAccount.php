<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory,Translatable;
    protected $fillable = ['date', 'patient_id', 'amount', 'description'];
    public $translatedAttributes = ['description'];
    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
