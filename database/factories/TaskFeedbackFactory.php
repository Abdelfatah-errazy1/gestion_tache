<?php

namespace Database\Factories;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskFeedback>
 */
class TaskFeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Tache::inRandomOrder()->first()->id ?? Tache::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'feedback' => fake()->paragraph(),
        ];
    }
}
