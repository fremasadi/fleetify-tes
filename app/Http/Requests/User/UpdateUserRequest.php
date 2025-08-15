<?php

namespace App\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user,
            'role' => 'required|string|in:admin,karyawan',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
}
