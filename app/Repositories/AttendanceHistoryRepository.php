<?php

namespace App\Repositories;

use App\Models\AttendanceHistory;

class AttendanceHistoryRepository
{
    public function create(array $data)
    {
        return AttendanceHistory::create($data);
    }

    public function updateOrCreate($conditions, $data)
    {
        return AttendanceHistory::updateOrCreate($conditions, $data);
    }

    public function deleteClockOutHistory($attendanceId)
    {
        return AttendanceHistory::where('attendance_id', $attendanceId)
            ->where('attendance_type', 2)
            ->delete();
    }
}
