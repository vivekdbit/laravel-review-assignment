<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EpisodeReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'review' => fake()->sentence(),
            'rating' => fake()->numberBetween(1,5),
            'user_id' => User::factory(),
            'episode_id' => fake()->unique()->randomNumber(1),
            'status' => fake()->randomElement(['ACTIVE','INACTIVE','DECLINE']),  
        ];
    }
}
