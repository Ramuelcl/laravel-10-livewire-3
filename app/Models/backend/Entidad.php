<?php
// app\Models\backend\Entidad.php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entidad extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'entidades';

    protected $fillable = [
        'tipo_entidad',
        'razonSocial',
        'website',
        'titulo',
        'nombres',
        'apellidos',
        'is_active',
        'aniversario',
        'sexo',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo_entidad' => 'integer',
        'is_active' => 'boolean',
        'aniversario' => 'date',
        'sexo' => 'boolean',
    ];

    public function entidadDireccionesIdForeigns(): HasMany
    {
        return $this->hasMany(Direccion::class);
    }

    // Relación belongsTo con la tabla "tablas" (asumo que "backend_tablas.tabla" se refiere a la tabla "tablas")
    public function tabla($tabla_id)
    {
        // tipo entidad
        $tabla = config('constantes.TIPO_ENTIDAD');
        return $this->belongsTo(Tabla::class, [$tabla, $tabla_id]);
    }

    // Relación hasMany con el modelo "Direccion"

    public function telefonos()
    {
        return $this->hasMany(Telefono::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
