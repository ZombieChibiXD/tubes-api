<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMachiningProjectRequest;
use App\Models\MachiningProject;
use App\Models\ToolMaterial;
use App\Models\ToolProduct;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Project",
 *     description="Everything about tools"
 * )
 */
class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     * @OA\Get(
     *   tags={"Project"},
     *   path="/api/project",
     *   summary="List tools and ongoing project",
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
     *           description="Tool materials",
     *           @OA\Items(ref="#/components/schemas/ToolMaterial")
     *         ),
     *         @OA\Property(
     *           property="projects",
     *           type="array",
     *           description="Tool products",
     *           @OA\Items(ref="#/components/schemas/MachiningProject")
     *         ),
     *         @OA\Property(
     *           property="machining",
     *           type="object",
     *           description="Machining parameters",
     *           @OA\Property(
     *             property="workpiece_materials",
     *             type="array",
     *             description="Workpiece materials",
     *             @OA\Items(type="string")
     *           ),
     *           @OA\Property(
     *             property="machining_processes",
     *             type="array",
     *             description="Machining processes",
     *             @OA\Items(type="string")
     *           ),
     *           @OA\Property(
     *             property="n",
     *             type="number",
     *             description="n Constant"
     *           ),
     *           @OA\Property(
     *             property="c",
     *             type="number",
     *             description="c Constant"
     *           )
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $toolMaterials = ToolMaterial::with('products')->with('products.items')->get();
        return response()->json([
            'materials' =>$toolMaterials,
            'projects' => MachiningProject::all(),
            'machining' => [
                'workpiece_materials' => [
                    'AISI 1018',
                    'AISI 1020',
                ],
                'machining_processes' => [
                    'Roughing',
                ],
                'n' => 0.25,
                'c' => 700,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     tags={"Project"},
     *   path="/api/project",
     *   summary="Create tool product",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectRequest")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/MachiningProject")
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Bad Request",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="object",
     *         @OA\Property(
     *           property="message",
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     */
    public function store(StoreMachiningProjectRequest $request)
    {
        $fields = $request->validated();

        // Check if an active project with the same tool_item_id exists
        $activeProject = MachiningProject::where('tool_item_id', $fields['tool_item_id'])
            ->where('is_active', true)
            ->first();
        
        if ($activeProject) {
            return response()->json([
                'message' => 'An active project with the same tool item already exists.'
            ], 400);
        }

        $project = MachiningProject::create($fields);
        $project->is_active = true;
        return response()->json($project, 201);
    }


    public function ongoing(){
        return response()->json(MachiningProject::where('is_active', true)->get());
    }
    public function history()
    {
        return response()->json(MachiningProject::where('is_active', false)->get());
    }
}
