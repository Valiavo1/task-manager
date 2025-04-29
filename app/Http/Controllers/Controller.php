<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Task Manager API",
 *     version="1.0.0",
 *     description="API documentation for Task Manager application",
 *     @OA\Contact(
 *         email="valiavoandriantsoa30@gmail.com",
 *         name="Valiavo"
 *     )
 * )
 *
 * @OA\Server(
 *     url="/api",
 *     description="APIs Server"
 * )
 *
 * @OA\Schema(
 *     schema="Task",
 *     required={"titre"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="titre", type="string"),
 *     @OA\Property(property="description", type="string", nullable=true),
 *     @OA\Property(property="completed", type="boolean", default=false),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="TaskRequest",
 *     required={"titre"},
 *     @OA\Property(property="titre", type="string", maxLength=255),
 *     @OA\Property(property="description", type="string", nullable=true),
 *     @OA\Property(property="completed", type="boolean", nullable=true)
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
