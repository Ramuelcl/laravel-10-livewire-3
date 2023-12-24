<?php

namespace App\Models\immo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//
// use App\Models\immo\Property;

class option extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // public function r_properties(): BelongsToMany
    // {
    //     return $this->belongsToMany(Property::class);
    // }
}
