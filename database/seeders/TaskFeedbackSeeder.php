<?php

namespace Database\Seeders;

use App\Models\Tache;
use App\Models\TaskFeedback;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task = Tache::first();
        $user = User::first();

        if ($task && $user) {
            TaskFeedback::create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'feedback' => 'Initial feedback for testing.',
            ]);
        }
    }
}
