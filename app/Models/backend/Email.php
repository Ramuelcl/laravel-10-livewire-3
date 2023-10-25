<?php
// app\Models\backend\Telefono.php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
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
        'entidad_id' => 'integer',
    ];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
