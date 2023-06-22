<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolItem;
use App\Http\Requests\StoreToolItemRequest;
use App\Http\Requests\UpdateToolItemRequest;
use App\Models\ToolProduct;

/**
 * @OA\Tag(
 *     name="ToolItem",
 *     description="Everything about tool items"
 * )
 */
class ToolItemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *   tags={"ToolItem"},
     *   path="/api/tool-products/{toolProduct}/tool-items",
     *   summary="List tool items",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     description="The tool product id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ToolItem")
     *       )
     *     )
     *   )
     * )
     */
    public function index(ToolProduct $toolProduct)
    {
        return response()->json($toolProduct->items);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *   tags={"ToolItem"},
     *   path="/api/tool-products/{toolProduct}/tool-items",
     *   summary="Create tool items",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     description="The tool product id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     description="The tool item request body",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="object",
     *         required={"amount"},
     *         @OA\Property(
     *           property="amount",
     *           description="The amount of tool items to be created",
     *           type="integer",
     *           example=5
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ToolItem")
     *       )
     *     )
     *   )
     * )
     */
    public function store(ToolProduct $toolProduct, StoreToolItemRequest $request)
    {
        // Get the amount of tool items to be created
        $amount = $request->input('amount');

        /**
         * @var ToolItem[] $newToolItems
         */
        $newToolItems = [];
        for ($i = 0; $i < $amount; $i++) {
            // Create a new tool item
            $toolItem = new ToolItem([
                'tool_product_id' => $toolProduct->id
            ]);
            $toolItem->save();
            
            // Add the tool item to the array
            $newToolItems[] = $toolItem;
        }

        // Return a response with the created tool items
        return response()->json($newToolItems, 201);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *   tags={"ToolItem"},
     *   path="/api/tool-products/{toolProduct}/tool-items/{toolItem}",
     *   summary="Get tool item details",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     description="The tool product id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="toolItem",
     *     description="The tool item id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolItem")
     *     )
     *   )
     * )
     */
    public function show(ToolProduct $toolProduct, ToolItem $toolItem)
    {
        $toolItem->load('toolProduct');
        $toolItem->load('toolProduct.materials');
        return response()->json($toolItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToolProduct $toolProduct, UpdateToolItemRequest $request, ToolItem $toolItem)
    {
        // Throw 404 route does not exist
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *   tags={"ToolItem"},
     *   path="/api/tool-products/{toolProduct}/tool-items/{toolItem}",
     *   summary="Delete tool item",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="toolProduct",
     *     description="The tool product id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="toolItem",
     *     description="The tool item id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/ToolItem")
     *     )
     *   )
     * )
     */
    public function destroy(ToolProduct $toolProduct, ToolItem $toolItem)
    {
        // Delete the tool item
        $toolItem->delete();

        // Return a response with the deleted tool item
        return response()->json($toolItem);
    }
}
