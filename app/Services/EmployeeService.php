<?php

namespace App\Services;

use App\DTOs\EmployeeDTO;
use App\Models\User;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepository $employeeRepository
    ) {}

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAll();
    }

    public function createEmployeeWithUser(array $userData, EmployeeDTO $employeeDTO)
    {
        // 1. Buat user dulu
        $user = User::create([
            'name'     => $userData['name'],
            'email'    => $userData['email'],
            'password' => Hash::make($userData['password']),
            'role'     => $userData['role'],
        ]);

        // 2. Buat employee pakai user_id
        return $this->employeeRepository->create([
            'employee_id'    => $user->id,
            'departement_id' => $employeeDTO->departement_id,
            'address'        => $employeeDTO->address,
        ]);
    }

    public function updateEmployee(Employee $employee, EmployeeDTO $employeeDTO)
    {
        return $this->employeeRepository->update($employee, [
            'departement_id' => $employeeDTO->departement_id,
            'address'        => $employeeDTO->address,
        ]);
    }

    public function deleteEmployee(Employee $employee)
    {
        return DB::transaction(function () use ($employee) {
            // 1. Hapus employee dulu
            $this->employeeRepository->delete($employee);
            
            // 2. Hapus user yang terkait
            if ($employee->user) {
                $employee->user->delete();
            }
            
            return true;
        });
    }
}
