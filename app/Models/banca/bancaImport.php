<?php

namespace App\Models\banca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bancaImport extends Model
{
    use HasFactory;
    public $table = 'banca_imports';
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dateMouvement' => 'string',
        'Libelle' => 'string',
        'montant' => 'decimal:2',
        'francs' => 'decimal:2',
    ];

    // public function setFechaMouvementAttribute($value)
    // {
    //     //siempre viene como d/m/Y, hay que cambiarlo am/d/Y
    //     $explode = explode('/', $value);

    //     $value = implode('/', [$explode[1], $explode[0], $explode[2]]);
    //     // Convierte la fecha a un objeto Carbon
    //     $fecha = Carbon::createFromFormat('d/m/Y', $value);
    //     // dd($fecha);
    //     // Establece el atributo 'dateMouvement' en el formato deseado (yyyymmdd)
    //     $this->attributes['dateMouvement'] = $fecha->format('Ydm');
    // }
}
