<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="UserUpdateRequest",
 *     title="User Update Request",
 *     description="Request body for updating a user.",
 *     required={"name", "username", "email", "role_ids"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="John Doe"),
 *     @OA\Property(property="username", type="string", maxLength=255, example="johndoe"),
 *     @OA\Property(property="password", type="string", minLength=8, example="password123"),
 *     @OA\Property(property="email", type="string", format="email", maxLength=255, example="mail@mail.com"),
 *     @OA\Property(property="role_ids", type="array", @OA\Items(type="integer"), example={1})
 * )
 */    
class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $model = $this->route('user');
        return $this->user()->can('update', $model);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('user')->id;
        return [
            'name' => 'required|string|max:255',
            // Username is unique except for the current user
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            // Email is unique except for the current user
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8',
            'role_ids' => 'required|array',
            'role_ids.*' => 'required|integer|exists:roles,id',
        ];
    }
}
