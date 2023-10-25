<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Todo;
use App\Models\TodoState;

class TodoStateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoState::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'todo_id' => Todo::factory(),
            'nameState' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'ok' => $this->faker->boolean,
        ];
    }
}
