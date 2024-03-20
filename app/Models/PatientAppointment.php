<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the user that owns the PatientAppointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
