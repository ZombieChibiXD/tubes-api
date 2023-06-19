<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Endpoints for user authentication"
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User login",
     *     description="Allows users to log in and obtain an authentication token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/UserLoginRequest"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="token",
     *                     type="string",
     *                     description="Access token for authentication",
     *                     example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
     *                 ),
     *                 @OA\Property(
     *                     property="token_type",
     *                     type="string",
     *                     description="Type of token",
     *                     example="Bearer"
     *                 ),
     *                 @OA\Property(
     *                     property="expires_in",
     *                     type="integer",
     *                     description="Duration of token validity in seconds",
     *                     example=3600
     *                 ),
     *                 @OA\Property(
     *                     property="user",
     *                     ref="#/components/schemas/User"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     description="Error message",
     *                     example="Invalid credentials"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function login(AuthLoginRequest $request)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="User logout",
     *     description="Logs out the authenticated user",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     description="Success message",
     *                     example="Logout successful"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function logout()
    {
        //
    }
}
