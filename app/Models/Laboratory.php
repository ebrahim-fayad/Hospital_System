<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function employee()
    {
        return $this->belongsTo(LaboratoryEmployee::class, 'laboratory_employee_id')->withDefault(['name'=>'No Employee']);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
