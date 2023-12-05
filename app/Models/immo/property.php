<?php

namespace App\Models\immo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'surface', 'rooms', 'bedrooms', 'floor', 'price', 'city', 'address', 'postal_code', 'sold'];
}
