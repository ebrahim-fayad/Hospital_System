<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory,Translatable;
    protected $fillable = ['name','description', 'price', 'status'];
    public $translatedAttributes = ['name','description'];

}
