<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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
            'conversation_id' => \App\Models\Conversation::factory(),
            'group_id' => \App\Models\Group::factory(),
            'channel_id' => \App\Models\Channel::factory(),
            'message' => $this->faker->text,
            'edited_at' => now(),
            'edited_by' => \App\Models\User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
