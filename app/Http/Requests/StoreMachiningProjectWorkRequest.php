<?php

namespace App\Http\Requests;

use App\Models\MachiningProject;
use App\Models\ToolProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     schema="StoreMachiningProjectWorkRequest",
 *     required={"machining_project_id", "product_id", "initial_diameter",
 *          "final_diameter", "workpart_length", "product_quantity",
 *          "machining_time"},
 *     @OA\Property(
 *         property="machining_project_id",
 *         type="integer",
 *         description="Machining project ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="product_id",
 *         type="string",
 *         description="Product ID",
 *         example="P0001"
 *     ),
 *     @OA\Property(
 *         property="initial_diameter",
 *         type="number",
 *         format="float",
 *         description="Initial diameter (mm)",
 *         example=100.0
 *     ),
 *     @OA\Property(
 *         property="final_diameter",
 *         type="number",
 *         format="float",
 *         description="Final diameter (mm)",
 *         example=50.0
 *     ),
 *     @OA\Property(
 *         property="workpart_length",
 *         type="number",
 *         format="float",
 *         description="Workpart length (mm)",
 *         example=100.0
 *     ),
 *     @OA\Property(
 *         property="machining_time",
 *         type="integer",
 *         description="Machining time (min)",
 *         example=10
 *     ),
 *     @OA\Property(
 *         property="product_quantity",
 *         type="integer",
 *         description="Product quantity",
 *         example=10
 *     ),
 * )
 */
class StoreMachiningProjectWorkRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get the tool product ID from the request field
        $machiningProjectId = $this->request->get('machining_project_id');
        Log::debug('machiningProjectId: ' . $machiningProjectId);
        // Get the tool product from the database
        $machiningProject = MachiningProject::find($machiningProjectId);
        Log::debug('machiningProject: ' . $machiningProject);
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $reqDecimalField = 'required|numeric|min:0';
        return [
            'machining_project_id' => 'required|integer|exists:machining_projects,id',
            'product_id' => 'required|string',
            'initial_diameter' => $reqDecimalField,
            'final_diameter' => $reqDecimalField,
            'workpart_length' => $reqDecimalField,
            'machining_time' => 'required|integer|min:1',
            'product_quantity' => 'required|integer|min:1',
        ];
    }
}
