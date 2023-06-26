<?php

namespace App\Http\Requests;

use App\Models\ToolProduct;
use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="StoreToolProductRequest",
 *     required={"tool_material_id", "code", "min_cutting_speed", "max_cutting_speed"},
 *     @OA\Property(
 *         property="tool_material_id",
 *         type="integer",
 *         description="Tool material ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="Tool product code",
 *         example="TP-001"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Karbida",
 *         description="Tool product name"
 *     ),
 *     @OA\Property(
 *         property="min_cutting_speed",
 *         type="integer",
 *         example=100,
 *         description="Minimum cutting speed (m/min)"
 *     ),
 *     @OA\Property(
 *         property="max_cutting_speed",
 *         type="integer",
 *         example=100,
 *         description="Maximum cutting speed (m/min)"
 *     )
 * )
 */
class StoreToolProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', ToolProduct::class);
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
            'code' => 'required|string|max:255|unique:tool_products,code',
            'prefix' => 'required|string|max:255|unique:tool_products,prefix',
            'name' => 'string|max:255',
            'min_cutting_speed' => 'required|integer|min:0',
            'max_cutting_speed' => 'required|integer|min:0|gt:min_cutting_speed'
        ];
    }
}
