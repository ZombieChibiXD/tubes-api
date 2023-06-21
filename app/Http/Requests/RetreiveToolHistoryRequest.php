<?php

namespace App\Http\Requests;

use App\Models\ToolProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     schema="RetreiveToolHistoryRequest",
 *     required={"tool_material_id", "tool_product_id", "tool_item_id"},
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
 *     )
 * )
 */
class RetreiveToolHistoryRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tool_material_id' => 'required|integer|exists:tool_materials,id',
            'tool_product_id' => 'required|integer|exists:tool_products,id',
            'tool_item_id' => 'required|integer|exists:tool_items,id'
        ];
    }
}
