<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolProduct;
use App\Http\Requests\StoreToolProductRequest;
use App\Http\Requests\UpdateToolProductRequest;

/**
 * @OA\Tag(
 *     name="ToolProduct",
 *     description="Endpoints for tool products"
 * )
 */
class ToolProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *   tags={"ToolProduct"},
     *   path="/api/tool/products",
     *   summary="List tool products",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ToolProduct")
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        return response()->json(ToolProduct::withCount('toolboxes')->get());
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     tags={"ToolProduct"},
     *   path="/api/tool/products",
     *   summary="Create tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/StoreToolProductRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/StoreToolProductRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/StoreToolProductRequest")
     *           )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolProduct")
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
    public function store(StoreToolProductRequest $request)
    {
        return response()->json(ToolProduct::create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *   tags={"ToolProduct"},
     *   path="/api/tool/products/{toolProduct}",
     *   summary="Show tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolProduct/properties/id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolProduct")
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
    public function show(ToolProduct $toolProduct)
    {
        return response()->json($toolProduct->load('materials'));
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *   tags={"ToolProduct"},
     *   path="/api/tool/products/{toolProduct}",
     *   summary="Update tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolProduct/properties/id")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolProductRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolProductRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/UpdateToolProductRequest")
     *           )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolProduct")
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
    public function update(UpdateToolProductRequest $request, ToolProduct $toolProduct)
    {
        return response()->json($toolProduct->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *   tags={"ToolProduct"},
     *   path="/api/tool/products/{toolProduct}",
     *   summary="Delete tool material",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     in="path",
     *     description="The tool material id",
     *     required=true,
     *     @OA\Schema(ref="#/components/schemas/ToolProduct/properties/id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolProduct")
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
    public function destroy(ToolProduct $toolProduct)
    {
        $toolProduct->delete();
        return response()->json($toolProduct);
    }
}
