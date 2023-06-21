<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolMaterial;
use App\Models\ToolProduct;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tool",
 *     description="Everything about tools"
 * )
 */
class ToolController extends Controller
{

    /**
     * Display a listing of the resource.
     * @OA\Get(
     *   tags={"Tool"},
     *   path="/api/tools",
     *   summary="List tools",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ToolMaterial")
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $toolMaterials = ToolMaterial::with('products')->with('products.items')->get();
        return response()->json($toolMaterials);
    }
}
