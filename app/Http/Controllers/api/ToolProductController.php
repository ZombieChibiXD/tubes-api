<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolProduct;
use App\Http\Requests\StoreToolProductRequest;
use App\Http\Requests\UpdateToolProductRequest;
use App\Models\ToolItem;
use App\Models\ToolMaterial;
use App\Models\ToolProductToolbox;

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
     *
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
     *         type="object",
     *         @OA\Property(
     *           property="materials",
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ToolMaterial")
     *         ),
     *         @OA\Property(
     *           property="products",
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ToolProduct")
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $materials = ToolMaterial::withCount('products')->get()->keyBy('id');
        $products = ToolProduct::withCount('toolboxes')->get()->keyBy('id');

        return response()->json([
            'materials' => $materials,
            'products' => $products
        ]);
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
        return response()->json(ToolProduct::create($request->validated())->loadCount('toolboxes'), 201);
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
    public function show(ToolProduct $product)
    {
        $product->toolboxes->each->loadCount('toolItems');
        return response()->json($product);
    }
    
    public function addToolbox(ToolProduct $product)
    {
        $toolbox = ToolProductToolbox::create([
            'tool_product_id' => $product->id
        ]);
        for ($i=1; $i <= 10; $i++) {
            ToolItem::create([
                    'tool_product_toolbox_id' => $toolbox->id,
                    'tool_color_code_id' => $i,
            ]);
        }

        $product->toolboxes->each->loadCount('toolItems');
        return response()->json($product);
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
    public function update(UpdateToolProductRequest $request, ToolProduct $product)
    {
        $product->update($request->validated());
        return response()->json($product->loadCount('toolboxes'));
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
    public function destroy(ToolProduct $product)
    {
        $product->delete();
        return response()->json($product);
    }
}
