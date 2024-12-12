<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message_id' => \App\Models\Message::factory(),
            'user_id' => \App\Models\User::factory(),
            'reaction_type' => $this->faker->randomElement(['like', 'love', 'haha', 'sad', 'angry']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
