<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
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
            'device_token' => $this->faker->uuid,
            'device_type' => $this->faker->randomElement(['mobile', 'desktop']),
            'device_info' => $this->faker->text,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
