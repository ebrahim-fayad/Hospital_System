<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name', 'Address'];
    public $fillable = ['email', 'Password', 'Date_Birth', 'Phone', 'gender_id', 'Blood_Group','name', 'Address'];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function PatientAccounts()
    {
        return $this->hasMany(PatientAccount::class, 'patient_id');
    }
}
