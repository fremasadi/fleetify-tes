<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departement_name' => ['required', 'string', 'max:255'],
            'max_clock_in_time' => ['nullable', 'date_format:H:i'],
            'max_clock_out_time' => ['nullable', 'date_format:H:i'],
        ];
    }
}
