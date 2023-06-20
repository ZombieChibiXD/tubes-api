<?php

namespace App\Http\Controllers\api;

use App\Exceptions\api\WrongCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     *             @OA\Schema(ref="#/components/schemas/AuthLoginRequest")
     *         ),
     *         @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(ref="#/components/schemas/AuthLoginRequest")
     *         ),
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/AuthLoginRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="token", ref="#/components/schemas/NewAccessToken"),
     *                 @OA\Property(property="user", ref="#/components/schemas/User")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *       response=403,
     *       description="Wrong credentials",
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/WrongCredentialException")
     *       )
     *     ),
     *     @OA\Response(
     *       response=422,
     *       description="Unprocessable Entity",
     *       @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/UnprocessableContentException")
     *       )
     *     )
     *  )
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials) === false) {
            throw new WrongCredentialException();
        }
        
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $expiresIn = 3600;
        $expiresAt = now()->addSeconds($expiresIn);
        $token = $user->createToken('authToken', $user->getRoleNames(), $expiresAt);
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    /**
     * @OA\Post(
     *   tags={"Auth"},
     *   path="/api/auth/logout",
     *   summary="Summary",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/User")
     *     ),
     *     @OA\MediaType(
     *       mediaType="*\*",
     *       @OA\Schema(ref="#/components/schemas/User")
     *     ),
     *   ),
     *   @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function logout(Request $request)
    {
        // Get the current authenticated token
        $user = $request->user();
        // Revoke the token
        $request->user()->currentAccessToken()->delete();
        return response()->json($user);
    }
}
