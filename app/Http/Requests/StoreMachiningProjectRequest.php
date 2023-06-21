<?php

namespace App\Http\Requests;

use App\Models\ToolProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     schema="StoreMachiningProjectRequest",
 *     required={"tool_material_id", "tool_product_id", "tool_item_id",
 *     "workpiece_material", "machining_process", "cutting_speed", "depth_of_cut",
 *     "feeding", "early_tool_life"},
 *     @OA\Property(
 *         property="tool_material_id",
 *         type="integer",
 *         description="Tool material ID",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="tool_product_id",
 *         type="integer",
 *         description="Tool product ID",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="tool_item_id",
 *         type="integer",
 *         description="Tool item ID",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="workpiece_material",
 *         type="string",
 *         description="Workpiece material",
 *         example="Stainless steel"
 *     ),
 *     @OA\Property(
 *         property="machining_process",
 *         type="string",
 *         description="Machining process",
 *         example="Milling"
 *     ),
 *     @OA\Property(
 *         property="cutting_speed",
 *         type="integer",
 *         description="Cutting speed (m/min)",
 *         example="100"
 *     ),
 *     @OA\Property(
 *         property="depth_of_cut",
 *         type="integer",
 *         description="Depth of cut (mm)",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="feeding",
 *         type="integer",
 *         description="Feeding (mm/min)",
 *         example="100"
 *     ),
 *     @OA\Property(
 *         property="early_tool_life",
 *         type="integer",
 *         description="Early tool life (min)",
 *         example="10"
 *     ),
 *     @OA\Property(
 *       property="is_active",
 *       type="boolean",
 *       description="Is active",
 *       example="true"
 *     )
 * )
 */
class StoreMachiningProjectRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get the tool product ID from the request field
        $toolProductId = $this->request->get('tool_product_id');
        Log::debug('toolProductId: ' . $toolProductId);
        // Get the tool product from the database
        $toolProduct = ToolProduct::find($toolProductId);
        Log::debug('toolProduct: ' . $toolProduct);
        
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
        $reqStrField = 'required|string';
        return [
            'tool_material_id' => 'required|integer|exists:tool_materials,id',
            'tool_product_id' => 'required|integer|exists:tool_products,id',
            'tool_item_id' => 'required|integer|exists:tool_items,id',
            'workpiece_material' => $reqStrField,
            'machining_process' => $reqStrField,
            'cutting_speed' => $reqDecimalField,
            'depth_of_cut' => $reqDecimalField,
            'feeding' => $reqDecimalField,
            'early_tool_life' => $reqDecimalField,
        ];
    }
}
