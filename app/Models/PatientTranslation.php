<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTranslation extends Model
{
    use HasFactory;
    /**
     * Summary of fillable
     * @var array
     */
    public $fillable = ['name', 'Address'];
    public $timestamps = false;
}
