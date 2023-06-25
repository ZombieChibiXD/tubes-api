<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ToolColorCode;
use App\Http\Requests\StoreToolColorCodeRequest;
use App\Http\Requests\UpdateToolColorCodeRequest;

/**
 * @OA\Tag(
 *     name="ToolColorCode",
 *     description="Everything about tools color code"
 * )
 */
class ToolColorCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *   tags={"ToolColorCode"},
     *   path="/api/tool/color-codes",
     *   summary="List tool color codes",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/ToolColorCode")
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolColorCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ToolColorCode $toolColorCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolColorCodeRequest $request, ToolColorCode $toolColorCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToolColorCode $toolColorCode)
    {
        //
    }
}
