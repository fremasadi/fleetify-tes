<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
            'role'           => ['required', 'in:karyawan,admin'],
            'departement_id' => ['required', 'exists:departements,id'],
            'address'        => ['nullable', 'string', 'max:255']
        ];
    }
}
