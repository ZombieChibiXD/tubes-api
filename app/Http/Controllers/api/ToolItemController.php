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
        return response()->json($toolProduct->toolItems()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToolProduct $toolProduct, StoreToolItemRequest $request)
    {
        // Get the amount of tool items to be created
        $amount = $request->input('amount');

        // TODO: Create the tool items
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
        return response()->json($toolItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToolProduct $toolProduct, UpdateToolItemRequest $request, ToolItem $toolItem)
    {
        // TODO: Update the tool item
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
