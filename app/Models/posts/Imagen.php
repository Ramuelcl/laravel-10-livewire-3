<?php
// app\Models\post\Imagen.php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imagenes';
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
        'user_id' => 'integer',
    ];

    public function mmMarcadors(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\backend\Marcador::class, 'imagenable');
    }

    public function mmCategorias(): MorphToMany
    {
        return $this->morphedByMany(\App\Models\backend\Categoria::class, 'imagenable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
