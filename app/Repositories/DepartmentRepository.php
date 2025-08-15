<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    public function getAll()
    {
        return Department::all();
    }

    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data)
    {
        return $department->update($data);
    }

    public function delete(Department $department)
    {
        return $department->delete();
    }
}
