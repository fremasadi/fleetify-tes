<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository
{
    public function getAllWithRelations()
    {
        return Attendance::with(['employee.user', 'employee.departement']);
    }

    public function getByEmployee($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)->latest()->get();
    }

    public function findTodayByEmployee($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)
            ->whereDate('created_at', now()->startOfDay())
            ->first();
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function update(Attendance $attendance, array $data)
    {
        return $attendance->update($data);
    }
    public function getAllHistories()
{
    return \App\Models\AttendanceHistory::with(['employee.user', 'attendance'])->latest()->get();
}

public function getHistoriesByEmployee($employeeId)
{
    return \App\Models\AttendanceHistory::where('employee_id', $employeeId)
        ->with('attendance')
        ->latest()
        ->get();
}

}
