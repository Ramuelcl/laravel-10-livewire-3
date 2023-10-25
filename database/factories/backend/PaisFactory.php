<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

use App\Models\backend\Pais;

class PaisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pais::class;
    protected $table = 'paises';

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paises = fncGlob_Files('C:\\laragon\\www\\lib\\images\\heroicons\\flags\\', "*", "jpeg");
        // dd($paises);

        foreach ($paises as  $value) {
            // dump([$value, $value['name']]);
            // dump([$value['filename'], $value['name']]);
            $name = str_replace($search = '_', $replace = ' ', $subject = $value['name']);
            DB::table($this->table)->insert([
                'nombre' => $name,
                'bandera' => $value['filename'],
                // 'idioma' => $value['name'],
            ]);
        }
        return [];
    }
}
