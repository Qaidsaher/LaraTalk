<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusViewer>
 */
class StatusViewerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_id' => \App\Models\Status::factory(),
            'viewer_user_id' => \App\Models\User::factory(),
            'viewed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
