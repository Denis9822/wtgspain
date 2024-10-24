<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'user_id' => fn () => User::query()
                ->inRandomOrder()->select('id')
                ->first(),
            'team_id' => fn () => Team::query()
                ->inRandomOrder()->select('id')
                ->first(),
        ];
    }
}
