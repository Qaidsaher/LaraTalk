<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSetting>
 */
class UserSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'dark_mode' => $this->faker->boolean,
            'notifications_enabled' => $this->faker->boolean,
            'language' => $this->faker->randomElement(['en', 'ar']),
            'preferences' => json_encode(['theme' => 'dark', 'notifications' => 'enabled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
