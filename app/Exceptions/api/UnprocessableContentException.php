<?php
namespace App\Exceptions\api;

use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="UnprocessableContentException",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Error message",
 *         example="Wrong username or password"
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
class UnprocessableContentException extends Exception
{
}
