<?php

namespace Database\Seeders;

use App\Models\backend\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Categoria2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Items = [
            [
                'nombre' => 'Desarrollo',
                'babosa' => Str::slug('Desarrollo'),
            ],
            [
                'nombre' => 'Programación',
                'babosa' => Str::slug('Programación'),
            ],
            [
                'nombre' => 'Diseño',
                'babosa' => Str::slug('Diseño'),
            ],
            [
                'nombre' => 'Diagramación',
                'babosa' => Str::slug('Diagramación'),
            ]
        ];
        foreach ($Items as $item) {
            Categoria::create($item);
        }
    }
}
