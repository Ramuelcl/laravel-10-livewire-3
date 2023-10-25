<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\backend\Ciudad;
use App\Models\backend\Direccion;
use App\Models\backend\Tabla as TipoDir;

class DireccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Direccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipoDir = TipoDir::all()->random(1);
        // $this->faker = Factory::create(['fr-FR']);

        $address = $this->faker->address;
        $dirs = explode("\n", $address);
        $pos = strpos($myString = $dirs[0], $findMy = ' ');
        $numero = (int) filter_var(
            substr($dirs[0], 0, $pos),
            FILTER_SANITIZE_NUMBER_INT
        );
        $calle = substr($dirs[0], $pos + 1);

        // echo NumberFormatter::create('en', NumberFormatter::SPELLOUT)->format(12309); // twelve

        $pos = strpos($myString = $dirs[1], $findMy = ', ');
        $codPostal = sprintf("%05d", (int)filter_var(substr($dirs[1], $pos + 2), FILTER_SANITIZE_NUMBER_INT));
        $ciudad = substr($dirs[1], 0, $pos);
        $ciudad_id = Ciudad::factory()->create(['nombre' => $ciudad])->id;
        // $ciudad_id = $ciudad_id->id;
        // $elementoAleatorio = $this->faker->randomElement(['casa', 'trabajo']);
        // dd([$dirs, $numero,$calle,$codPostal,$ciudad_id]);

        return [
            'tipo' => $tipoDir,
            'direccion' =>  $numero . ', ' . $calle,
            'codigo_postal' => $codPostal,
            'ciudad_id' => $ciudad_id,
            'region' => '',
        ];
    }
}
