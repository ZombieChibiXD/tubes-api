<?php
namespace App\Exceptions\api;

use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="ModelNotFoundException",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Error message",
 *         example="No query results for model [App\Models\ToolMaterial] 1"
 *     ),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         description="Validation errors",
 *         @OA\AdditionalProperties(
 *             type="array",
 *             @OA\Items(
 *                 type="string",
 *                 example="The name field is required."
 *             )
 *         )
 *     )
 * )
 */
class ModelNotFoundException extends Exception
{
}
