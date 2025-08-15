<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function getAll()
    {
        return Employee::with(['user', 'departement'])->get();
    }

    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }
}
