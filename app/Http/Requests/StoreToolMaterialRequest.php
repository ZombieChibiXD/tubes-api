<?php

namespace App\Http\Requests;

use App\Models\ToolMaterial;
use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="StoreToolMaterialRequest",
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
class StoreToolMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', ToolMaterial::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tool_materials',
            'description' => 'nullable|string',
        ];
    }
}
