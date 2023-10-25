<?php
// app\Models\backend\Marcador.php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marcador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'marcadores';
    protected $fillable = [
        'nombre', 'babosa',
        'hexa', 'rgb',
        'metadata',
        'is_active'
    ];
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
        'id' => 'integer',
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];

    // relacion n->n
    public function posts()
    {
        return $this->belongsToMany(\App\Models\posts\Post::class);
    }
}
