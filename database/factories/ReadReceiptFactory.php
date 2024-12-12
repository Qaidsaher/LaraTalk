<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReadReceipt>
 */
class ReadReceiptFactory extends Factory
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
            'read_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
