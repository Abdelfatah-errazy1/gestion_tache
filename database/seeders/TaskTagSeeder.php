<?php

namespace Database\Seeders;

use App\Models\TaskTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskTag::factory()->count(10)->create();

    }
}
