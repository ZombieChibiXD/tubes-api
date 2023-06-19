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
 *       example="user123"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="User's password",
 *         example="password123"
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
            'username' => 'string|required|exists:users,username',
            'password' => 'string|required',
        ];
    }
}