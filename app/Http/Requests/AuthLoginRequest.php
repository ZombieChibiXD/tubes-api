<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="AuthLoginRequest",
 *     required={"username", "password"},
 *     @OA\Property(
 *       property="username",
 *       type="string",
 *       description="User's username",
 *       example="admin"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="User's password",
 *         example="password"
 *     )
 * )
 */
class AuthLoginRequest extends FormRequest
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
            'username' => 'string|required',
            'password' => 'string|required',
        ];
    }
}
