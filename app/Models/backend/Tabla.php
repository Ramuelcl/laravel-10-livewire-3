<?php
// app\Models\backend\Tabla.php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabla extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tablas';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tabla' => 'integer',
        'tabla_id' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeTabla($query, $tabla)
    {
        return $query->where('tabla', $tabla)
            ->where('is_active', true);
    }

    public function scopeTabla_Id($query, $tabla, $id)
    {
        return $query->where('tabla', $tabla)
            ->where('tabla_id', $id)
            ->where('is_active', true);
    }
}
