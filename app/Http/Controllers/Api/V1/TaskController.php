<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/tasks",
     *     summary="Liste de toutes les tâches",
     *     tags={"Tasks V1"},
     *     @OA\Response(
     *         response=200,
     *         description="Succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Task")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(new TaskCollection(Task::all()));
    }

    /**
     * @OA\Post(
     *     path="/v1/tasks",
     *     summary="Créer une nouvelle tâche",
     *     tags={"Tasks V1"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre"},
     *             @OA\Property(property="titre", type="string", example="Ma tâche"),
     *             @OA\Property(property="description", type="string", example="Description de la tâche"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tâche créée avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation"
     *     )
     * )
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());
        return response()->json(new TaskResource($task), 201);
    }

    /**
     * @OA\Get(
     *     path="/v1/tasks/{id}",
     *     summary="Obtenir une tâche spécifique",
     *     tags={"Tasks V1"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Succès",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tâche non trouvée"
     *     )
     * )
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json(new TaskResource($task));
    }

    /**
     * @OA\Put(
     *     path="/v1/tasks/{id}",
     *     summary="Mettre à jour une tâche",
     *     tags={"Tasks V1"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titre", type="string", example="Tâche mise à jour"),
     *             @OA\Property(property="description", type="string", example="Description mise à jour"),
     *             @OA\Property(property="completed", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tâche mise à jour avec succès",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tâche non trouvée"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation"
     *     )
     * )
     */
    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());
        return response()->json(new TaskResource($task));
    }

    /**
     * @OA\Delete(
     *     path="/v1/tasks/{id}",
     *     summary="Supprimer une tâche",
     *     tags={"Tasks V1"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Tâche supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tâche non trouvée"
     *     )
     * )
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
