<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $model = User::findOrFail($this->route('id'));
        return $this->user()->can('update', $model);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'name' => 'string|max:255',
            // Username is unique except for the current user
            'username' => 'string|max:255|unique:users,username,' . $id,
            // Email is unique except for the current user
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8'
        ];
    }
}
