<?php

namespace Database\Factories;

use App\Models\ChannelUser;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChannelUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_id' => Channel::factory(),
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['admin', 'moderator', 'member']),
        ];
    }
}
