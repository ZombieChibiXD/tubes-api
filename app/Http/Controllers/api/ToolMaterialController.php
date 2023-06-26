<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolMaterial;
use App\Http\Requests\StoreToolMaterialRequest;
use App\Http\Requests\UpdateToolMaterialRequest;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 *     name="ToolMaterial",
 *     description="Endpoints for tool materials"
 * )
 */
class ToolMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *   tags={"ToolMaterial"},
     *   path="/api/tool/materials",
     *   summary="List tool materials",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(
     *           property="materials",
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ToolMaterial")
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $materials = ToolMaterial::withCount('products')->get()->keyBy('id');
        return response()->json([
            'materials' => $materials
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     tags={"ToolMaterial"},
     *   path="/api/tool/materials",
     *   summary="Create tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/StoreToolMaterialRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/StoreToolMaterialRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/StoreToolMaterialRequest")
     *           )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolMaterial")
     *     )
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Unprocessable Entity",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UnprocessableContentException")
     *     )
     *   )
     * )
     */
    public function store(StoreToolMaterialRequest $request)
    {
        return response()->json(ToolMaterial::create($request->validated())->loadCount('products'), 201);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *   tags={"ToolMaterial"},
     *   path="/api/tool/materials/{toolMaterial}",
     *   summary="Show tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolMaterial",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolMaterial/properties/id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolMaterial")
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not Found",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ModelNotFoundException")
     *     )
     *   )
     * )
     */
    public function show(ToolMaterial $material)
    {
        return response()->json($material->load('products'));
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *   tags={"ToolMaterial"},
     *   path="/api/tool/materials/{toolMaterial}",
     *   summary="Update tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolMaterial",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolMaterial/properties/id")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolMaterialRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolMaterialRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolMaterialRequest")
     *           )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolMaterial")
     *     )
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Unprocessable Entity",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UnprocessableContentException")
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not Found",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ModelNotFoundException")
     *     )
     *   )
     * )
     */
    public function update(UpdateToolMaterialRequest $request, ToolMaterial $material)
    {
        $material->update($request->validated());
        return response()->json($material->loadCount('products'));
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *   tags={"ToolMaterial"},
     *   path="/api/tool/materials/{toolMaterial}",
     *   summary="Delete tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolMaterial",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolMaterial/properties/id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolMaterial")
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not Found",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ModelNotFoundException")
     *     )
     *   )
     * )
     */
    public function destroy(ToolMaterial $material)
    {
        $material->delete();
        return response()->json($material);
    }
}
