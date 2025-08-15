<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departement_id' => ['required', 'exists:departements,id'],
            'address'        => ['nullable', 'string', 'max:255']
        ];
    }
}
