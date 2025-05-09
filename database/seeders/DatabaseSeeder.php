<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'is_admin' => false,
        ]);
       
        $this->call(TaskCategorySeeder::class);
        $this->call(TaskTagSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ProjectSeeder::class);
        \App\Models\Tache::factory(10)->create();
    }
}
