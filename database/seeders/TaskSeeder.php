<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory()->create([
            'title' => 'Apprendre Laravel',
            'description' => 'Étudier le framework Laravel en profondeur',
            'completed' => true,
        ]);

        Task::factory()->create([
            'title' => 'Développer une API RESTful',
            'description' => 'Créer une API complète avec Laravel',
            'completed' => false,
        ]);

        Task::factory()->create([
            'title' => 'Documenter avec Swagger',
            'description' => 'Mettre en place la documentation Swagger pour l\'API',
            'completed' => false,
        ]);

        Task::factory()->count(5)->create();

        Task::factory()->completed()->count(3)->create();
    }
}
