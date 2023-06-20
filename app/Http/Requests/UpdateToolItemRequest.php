<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *     schema="UpdateToolItemRequest",
 *     required={}
 * )
 */
class UpdateToolItemRequest extends UpdateToolProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // TODO: Add validation rules
        ];
    }
}
