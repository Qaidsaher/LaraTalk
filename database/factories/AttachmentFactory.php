<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
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
            'file_path' => $this->faker->imageUrl(),
            'file_type' => $this->faker->randomElement(['image', 'video']),
            'file_name' => $this->faker->word . '.' . $this->faker->fileExtension,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
