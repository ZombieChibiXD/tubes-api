<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateToolProductRequest",
 *     required={"code", "min_cutting_speed", "max_cutting_speed"},
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
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of creation",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of last update",
 *         example="2020-01-01 00:00:00"
 *     )
 * )
 */
class UpdateToolProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('tool_product'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $toolProduct = $this->route('tool_product');
        return [
            'code' => 'required|string|max:255|unique:tool_products,code,' . $toolProduct->id,
            'name' => 'string|max:255',
            'min_cutting_speed' => 'required|integer|min:0',
            'max_cutting_speed' => 'required|integer|min:0|gt:min_cutting_speed',
        ];
    }
}
