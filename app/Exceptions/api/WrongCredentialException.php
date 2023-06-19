<?php

namespace App\Exceptions\api;

use Exception;
use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="WrongCredentialException",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Error message",
 *         example="Wrong username or password"
 *     ),
 *     @OA\Property(
 *       property="error_code",
 *       type="integer",
 *       description="Error code",
 *       example=403001
 *     )
 * )
 */
class WrongCredentialException extends Exception implements Responsable
{
    public function render(Request $request)
    {
        return response()->json([
            'message' => 'Wrong username or password',
            'error_code' => 403001,
        ], 403);
    }
}
