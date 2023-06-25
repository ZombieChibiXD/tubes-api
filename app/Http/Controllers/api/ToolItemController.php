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
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ToolItem $toolItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolItemRequest $request, ToolItem $toolItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToolItem $toolItem)
    {
        //
    }
}
