<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Doctor extends Authenticatable
{
    use Translatable,HasFactory;
    public $translatedAttributes = ['name'];
    public $fillable= ['email','email_verified_at','password','phone','name','section_id', 'status'];
    //protected $guarded=[];

    /**
     * Get the Doctor's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // One To One get section of Doctor
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function doctorAppointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_doctor');
    }

    public function Invoices()
    {
        return $this->hasMany(Invoice::class);
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
