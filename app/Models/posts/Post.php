<?php
// app\Models\post\Post.php

namespace App\Models\posts;

// use App\Models\backend\Categoria;
// use App\Models\backend\Marcador;
//
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'titulo', 'babosa',
        'contenido', 'image_path',
        'categoria_id',
        'publicado', 'actualisado'
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
        'user_id' => 'integer',
        'publicado' => 'timestamp',
        'actualizado' => 'timestamp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // relacion 1->n inversa
    public function categoria()
    {
        return $this->belongsTo(\App\Models\backend\Categoria::class, 'categoria_id');
    }

    // relacion n->n
    public function marcadores()
    {
        return $this->belongsToMany(\App\Models\backend\Marcador::class);
    }
    // public function mmMarcadors(): MorphToMany
    // {
    //     return $this->morphedByMany(\App\Models\backend\Marcador::class, 'postable');
    // }

    // public function mmCategorias(): MorphToMany
    // {
    //     return $this->morphedByMany(\App\Models\backend\Categoria::class, 'postable');
    // }
}
