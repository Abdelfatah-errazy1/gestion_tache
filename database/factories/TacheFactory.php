<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tache>
 */
class TacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = $this->faker->dateTimeBetween('-1 month', 'now');
        $dateFin = $this->faker->dateTimeBetween($dateDebut, '+1 month');
        $dateEffective = $this->faker->dateTimeBetween($dateDebut, $dateFin);

        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d'),
            'date_effective' => $dateEffective->format('Y-m-d'),
            'priorite' => $this->faker->numberBetween(1, 5),
            'statut' => $this->faker->numberBetween(1, 5),
            'progress' => $this->faker->numberBetween(0, 100),
            'created_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'project_id' => Project::inRandomOrder()->first()?->id ?? Project::factory(),
            'category_id' => TaskCategory::inRandomOrder()->first()?->id ?? TaskCategory::factory(),
            'assigned_to' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
