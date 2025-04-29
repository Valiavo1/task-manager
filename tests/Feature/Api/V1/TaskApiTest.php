<?php

namespace Tests\Feature\Api\V1;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\TaskSeeder;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test l'obtention de la liste des tâches.
     */
    public function test_can_get_all_tasks(): void
    {
        $this->seed(TaskSeeder::class);

        $response = $this->getJson('/api/v1/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'taches' => [
                    '*' => [
                        'id',
                        'titre',
                        'description',
                        'completed',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /**
     * Test la création d'une tâche.
     */
    public function test_can_create_task(): void
    {
        $taskData = [
            'titre' => 'Nouvelle tâche',
            'description' => 'Description de la nouvelle tâche',
        ];

        $response = $this->postJson('/api/v1/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'titre' => 'Nouvelle tâche',
                'description' => 'Description de la nouvelle tâche',
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Nouvelle tâche',
            'description' => 'Description de la nouvelle tâche',
        ]);
    }

    /**
     * Test l'obtention d'une tâche spécifique.
     */
    public function test_can_get_single_task(): void
    {
        $task = Task::factory()->create([
            'title' => 'Tâche de test',
            'description' => 'Description de test',
            'completed' => false
        ]);

        $response = $this->getJson("/api/v1/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson([
                'titre' => 'Tâche de test',
                'description' => 'Description de test',
                'completed' => false
            ]);
    }

    /**
     * Test la mise à jour d'une tâche.
     */
    public function test_can_update_task(): void
    {
        $task = Task::factory()->create();

        $updatedData = [
            'titre' => 'Tâche mise à jour',
            'description' => 'Description mise à jour',
            'completed' => true
        ];

        $response = $this->putJson("/api/v1/tasks/{$task->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'titre' => 'Tâche mise à jour',
                'description' => 'Description mise à jour',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Tâche mise à jour',
            'description' => 'Description mise à jour',
            'completed' => 1
        ]);
    }

    /**
     * Test la suppression d'une tâche.
     */
    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Test la validation lors de la création d'une tâche.
     */
    public function test_cannot_create_task_without_title(): void
    {
        $response = $this->postJson('/api/v1/tasks', [
            'description' => 'Description sans titre'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['titre']);
    }
}
