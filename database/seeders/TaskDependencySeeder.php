<?php

namespace Database\Seeders;

use App\Models\Tache;
use App\Models\TaskDependency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskDependencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Tache::all();

        if ($tasks->count() >= 2) {
            TaskDependency::create([
                'task_id' => $tasks[1]->id,
                'depends_on_task_id' => $tasks[0]->id,
            ]);
        }
    }
}
