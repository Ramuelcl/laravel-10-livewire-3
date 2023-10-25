<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Ciudad;

class CiudadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ciudad::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pais_id' => $this->faker->regexify('[0-9]{10}'),
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
