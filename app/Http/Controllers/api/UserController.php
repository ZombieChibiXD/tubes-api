<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;


/**
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users"
 * )
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *    path="/api/users",
     *    summary="Get All Users",
     *    tags={"Users"},
     *    security={
     *      {"bearerAuth": {}}
     *    },
     *    @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\AdditionalProperties(
     *            ref="#/components/schemas/User"
     *          ),
     *      ),
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *    )
     * )
     */
    public function index()
    {
        return response()->json(User::with('roles')->get()->keyBy('id'));
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create User",
     *     tags={"Users"},
     *     security={
     *       {"bearerAuth": {}}
     *     },
     *     @OA\RequestBody(
     *         description="User Create Request",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->attach($request->role_ids);
        return response()->json($user->load('roles'), 201);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/api/users/{user}",
     *     summary="Get User",
     *     tags={"Users"},
     *     security={
     *       {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *     path="/api/users/{user}",
     *     summary="Update User",
     *     tags={"Users"},
     *     security={
     *       {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="User Update Request",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->role_ids);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user);
    }
}
