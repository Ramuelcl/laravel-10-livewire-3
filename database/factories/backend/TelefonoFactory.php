<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Telefono;

class TelefonoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Telefono::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->regexify('[A-Za-z0-9]{2}'),
            'numero' => $this->faker->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
