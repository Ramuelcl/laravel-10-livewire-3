<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\backend\UserSetting;

class UserSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSetting::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'theme' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'language' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'autologin' => $this->faker->boolean,
            'ipVisitor' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'options' => 'null',
            'device' => $this->faker->regexify('[A-Za-z0-9]{17}'),
        ];
    }
}
