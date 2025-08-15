<?php

namespace App\Http\Controllers;

use App\DTOs\EmployeeDTO;
use App\Models\Employee;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {}

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeService->createEmployeeWithUser(
            $request->only(['name', 'email', 'password', 'role']),
            new EmployeeDTO(
                employee_id: 0, // akan diisi otomatis
                departement_id: $request->departement_id,
                address: $request->address
            )
        );

        return redirect()->route('employees.index')->with('Berhasil', 'Karyawan Berhasil Dibuat.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeService->updateEmployee(
            $employee,
            new EmployeeDTO(
                employee_id: $employee->employee_id,
                departement_id: $request->departement_id,
                address: $request->address
            )
        );

        return redirect()->route('employees.index')->with('Berhasil', 'Karyawan Berhasil Diupdate.');
    }

    public function destroy(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('employees.index')->with('Berhasil', 'Karyawan Berhasil Dihapus.');
    }
}
