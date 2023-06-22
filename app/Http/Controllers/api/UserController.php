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
     *        type="array",
     *        @OA\Items(ref="#/components/schemas/User")
     *      )
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *    )
     * )
     */
    public function index()
    {
        return response()->json(User::with('roles')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        return response()->json(User::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
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
