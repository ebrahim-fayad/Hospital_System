<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name', 'Address'];
    public $fillable = ['email', 'password', 'Date_Birth', 'Phone', 'gender_id', 'Blood_Group','name', 'Address'];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function PatientAccounts()
    {
        return $this->hasMany(PatientAccount::class, 'patient_id');
    }

    public function Rays()
    {
        return $this->hasMany(Ray::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
