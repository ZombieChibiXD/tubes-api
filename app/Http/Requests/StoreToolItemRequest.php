<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreToolItemRequest",
 *     required={"amount"},
 *     @OA\Property(
 *         property="amount",
 *         type="integer",
 *         description="Amount of tool items",
 *         example=10
 *     )
 * )
 */
class StoreToolItemRequest extends StoreToolProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|integer|min:1'
        ];
    }
}
