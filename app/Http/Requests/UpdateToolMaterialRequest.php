<?php

namespace App\Http\Requests;

use App\Models\ToolMaterial;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateToolMaterialRequest",
 *     required={"name"},
 *     @OA\Property(
 *       property="name",
 *       type="string",
 *       example="Karbida",
 *       description="Name of the tool material"
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string",
 *       example="Karbida is a material used for tools",
 *       description="Description of the tool material"
 *     )
 * )
 */
class UpdateToolMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $material = $this->route('material');
        return $this->user()->can('update', $material);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('material')->id;
        return [
            'name' => 'required|string|max:255|unique:tool_materials,name,' . $id,
            'description' => 'nullable|string',
        ];
    }
}
