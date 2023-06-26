<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Roles",
 *     description="API Endpoints of Roles"
 * )
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *     path="/api/roles",
     *     summary="Get All Roles",
     *     tags={"Roles"},
     *     security={
     *       {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *       response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Role")
     *       )
     *     ),
     *     @OA\Response(
     *       response=401,
     *       description="Unauthenticated"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Role::all());
    }
}
