<?php
// app\Models\backend\Telefono.php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Telefono extends Model
{
    use HasFactory;

    protected $table = 'telefonos';
    protected $primary = 'id';

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
        'id_entidad' => 'integer',
    ];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class, 'id_entidad');
    }
}
