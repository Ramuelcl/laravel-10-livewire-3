<?php
// app\Models\backend\Direccion.php


namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'direcciones';

    protected $fillable = [
        'calle',
        'ciudad_id',
        'pais_id',
        // Otros campos de dirección...
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ciudad_id' => 'integer',
    ];

    // Otras relaciones y métodos...
    // Relación belongsTo con la tabla "entidades"
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    // Relación belongsTo con la tabla "ciudades"
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
