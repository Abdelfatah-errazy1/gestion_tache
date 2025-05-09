<?php

namespace Database\Factories;

use App\Models\Tache;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskDependency>
 */
class TaskDependencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $task1 = Tache::inRandomOrder()->first();
        $task2 = Tache::where('id', '!=', $task1->id)->inRandomOrder()->first();

        return [
            'task_id' => $task1->id ?? Tache::factory(),
            'depends_on_task_id' => $task2->id ?? Tache::factory(),
        ];
    }
}
