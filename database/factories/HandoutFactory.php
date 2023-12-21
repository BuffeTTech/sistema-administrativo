<?php

namespace Database\Factories;

use App\Enums\HandoutStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Handout>
 */
class HandoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray();

        return [
            'title' => fake()->sentence(),
            'body' => fake()->text(),
            'author_id' => fake()->randomElement($users),
            'send_in' => fake()->dateTimeThisMonth('+2 days'),
            'status' => fake()->randomElement(array_column(HandoutStatus::cases(), 'name')),
        ];
    }
}
