<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name', 'notes'];
    public $fillable = ['name', 'notes','Total_before_discount', 'discount_value', 'Total_after_discount', 'tax_rate', 'Total_with_tax'];
    /**
     * The roles that belong to the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_group_pivot')->withTimestamps()
        ->withPivot('quantity');
    }
}
