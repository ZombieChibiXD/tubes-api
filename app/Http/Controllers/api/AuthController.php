<?php

namespace App\Http\Controllers\api;

use App\Exceptions\api\WrongCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
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
     *                 @OA\Property(
     *                     property="token",
     *                     type="object",
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         description="Token name",
     *                         example="authToken"
     *                     ),
     *                     @OA\Property(
     *                         property="abilities",
     *                         type="array",
     *                         description="Token abilities",
     *                         @OA\Items(
     *                             type="string",
     *                             example="ADMINISTRATOR"
     *                         )
     *                     ),
     *                     @OA\Property(
     *                         property="expires_at",
     *                         type="string",
     *                         format="date-time",
     *                         description="Token expiration date",
     *                         example="2023-06-19T15:36:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="tokenable_id",
     *                         type="integer",
     *                         description="Tokenable ID",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="tokenable_type",
     *                         type="string",
     *                         description="Tokenable type",
     *                         example="App\\Models\\User"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time",
     *                         description="Updated at date",
     *                         example="2023-06-19T14:36:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time",
     *                         description="Created at date",
     *                         example="2023-06-19T14:36:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Token ID",
     *                         example=2
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="user",
     *                     ref="#/components/schemas/User"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *       response=403,
     *       description="Unauthorized",
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
     * @OA\Get(
     *   tags={"Auth"},
     *   path="/api/auth",
     *   summary="Summary",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function logout()
    {
        return response()->json([
            'message'=>'Logout successful'
        ], 200);
    }
}