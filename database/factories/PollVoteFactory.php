<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PollVote>
 */
class PollVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poll_option_id' => \App\Models\PollOption::factory(),
            'user_id' => \App\Models\User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
