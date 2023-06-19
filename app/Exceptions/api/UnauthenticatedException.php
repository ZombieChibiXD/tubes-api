<?php

namespace App\Exceptions\api;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="UnauthenticatedException",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Error message",
 *         example="Unauthenticated."
 *     )
 * )
 */
class UnauthenticatedException extends AuthenticationException implements Responsable
{
    public function render(Request $request)
    {
        return response()->json([
            'message' => 'Unauthenticated.'
        ], 401);
    }
}
