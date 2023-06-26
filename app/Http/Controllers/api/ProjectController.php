<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RetreiveToolHistoryRequest;
use App\Http\Requests\StoreMachiningProjectRequest;
use App\Http\Requests\StoreMachiningProjectWorkRequest;
use App\Models\MachiningProject;
use App\Models\MachiningProjectWork;
use App\Models\ToolColorCode;
use App\Models\ToolItem;
use App\Models\ToolMaterial;
use App\Models\ToolProduct;
use Illuminate\Contracts\Cache\Store;
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
     * Display a listing of the form data.
     * @OA\Get(
     *   tags={"Project"},
     *   path="/api/project/form",
     *   summary="List tools and ongoing project",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="filter",
     *     in="query",
     *     required=false,
     *     @OA\Schema(type="string"),
     *     description="Filter tools by status (NEW, ONGOING, HISTORY)",
     *     example="NEW"
     *   ),
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
    public function form(Request $request)
    {
        $filter = $request->query('filter', 'NEW');
        $filterItem = function ($q) use ($filter) {
            $q->project($filter);
        };
        $filterToolbox = function ($q) use ($filterItem) {
            $q->withWhereHas('toolItems', $filterItem);
        };
        $filterProduct = function ($q) use ($filterToolbox) {
            $q->withWhereHas('toolboxes', $filterToolbox);
        };
        $builder = ToolMaterial::withWhereHas('products', $filterProduct);


        $toolMaterials = $builder->get();
        $colors = ToolColorCode::all()->keyBy('id');
        $machiningProjects = MachiningProject::where('is_active', true)->get();
        return response()->json([
            'materials' => $toolMaterials,
            'colors' => $colors,
            'projects' => $machiningProjects,
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
                'message' => 'An active project with the same tool item already exists.',
                'errors' => [
                    'tool_item_id' => [
                        'An active project with the same tool item already exists.'
                    ]
                ]
            ], 400);
        }

        $project = MachiningProject::create($fields);
        $project->is_active = true;
        $project->load('toolItem.toolProductToolbox.toolProduct.material');
        return response()->json($project, 201);
    }


    /**
     * Store a newly created work on an ongoing project in storage.
     * @OA\Post(
     *     tags={"Project"},
     *   path="/api/project/ongoing",
     *   summary="Create work on an ongoing project",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectWorkRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectWorkRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/StoreMachiningProjectWorkRequest")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/MachiningProjectWork")
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Bad Request",
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
    public function update(MachiningProject $project, StoreMachiningProjectWorkRequest $request)
    {
        $fields = $request->validated();
        if (!$project) {
            return response()->json([
                'message' => 'Project not found.'
            ], 404);
        }
        $failed = false;
        $addedTime = $fields['machining_time'] * $fields['product_quantity'];
        $errors = [];
        $message = 'Unknown error';
        if ($project->remaining_tool_life < $addedTime) {
            $message = $remainMessage = 'Machining time exceeds remaining tool life by '
                . ($addedTime - $project->remaining_tool_life) . ' minutes.';
            $failed = true;
            $errors['machining_time'] = [$remainMessage];
            $errors['product_quantity'] = [$remainMessage];
            $errors['remaining_tool_life'] = [$remainMessage];
        }
        if (!$project->is_active) {
            $failed = true;
            $message = 'Project is not active.';
            $errors['tool_material_id'] = $message;
            $errors['tool_product_id'] = $message;
            $errors['tool_item_id'] = $message;
        }
        if ($failed) {
            return response()->json([
                'message' => $message,
                'errors' => $errors
            ], 400);
        }
        /**
         * @var MachiningProjectWork $machiningWork
         */
        $machiningWork = MachiningProjectWork::create($fields);
        $project = $machiningWork->machiningProject;

        if ($project->remaining_tool_life == 0) {
            $project->is_active = false;
            $project->save();
        }
        $project->load('machiningProjectWorks');
        return response()->json($project, 201);
    }

    /**
     * Display the specified history of machining projects.
     * @OA\Post(
     *   tags={"Project"},
     *   path="/api/project/tool/history",
     *   summary="Get history of machining projects",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/RetreiveToolHistoryRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(ref="#/components/schemas/RetreiveToolHistoryRequest")
     *     ),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(ref="#/components/schemas/RetreiveToolHistoryRequest")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/MachiningProject")
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Bad Request",
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
    public function history(ToolItem $tool)
    {
        $tool->load('toolColorCode')
            ->load('toolProductToolbox.toolProduct.material')
            ->load('machiningProjects.machiningProjectWorks');
        return response()->json($tool, 200);
    }
}
