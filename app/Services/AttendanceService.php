<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Repositories\AttendanceHistoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceService
{
    const CLOCK_IN = 1;
    const CLOCK_OUT = 2;

    protected $attendanceRepo;
    protected $historyRepo;

    public function __construct(
        AttendanceRepository $attendanceRepo,
        AttendanceHistoryRepository $historyRepo
    ) {
        $this->attendanceRepo = $attendanceRepo;
        $this->historyRepo = $historyRepo;
    }

    public function clockIn($employee)
{
    DB::beginTransaction();
    try {
        $already = $this->attendanceRepo->findTodayByEmployee($employee->id);

        if ($already) {
            throw new \Exception('Anda sudah melakukan Clock In hari ini.');
        }

        $attendance = $this->attendanceRepo->create([
            'employee_id' => $employee->id,
            'clock_in' => now(),
        ]);

        // Ambil jam masuk departemen (default 08:00:00)
        $maxClockIn = $employee->department->max_clock_in_time ?? '08:00:00';
        $status = now()->format('H:i:s') > $maxClockIn ? 'Telat' : 'Tepat Waktu';

        $this->historyRepo->create([
            'employee_id'     => $employee->id,
            'attendance_id'   => $attendance->id,
            'date_attendance' => now()->toDateString(),
            'attendance_type' => self::CLOCK_IN,
            'description'     => "Clock In pada " . now()->format('H:i:s') . " ($status)",
        ]);

        DB::commit();
        return ['success' => true, 'message' => 'Clock In berhasil.'];

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Clock In Error: ' . $e->getMessage());
        return ['success' => false, 'message' => $e->getMessage()];
    }
}


    public function clockOut($employee)
    {
        DB::beginTransaction();
        try {
            $attendance = $this->attendanceRepo->findTodayByEmployee($employee->id);

            if (!$attendance) {
                throw new \Exception('Anda belum Clock In.');
            }

            if ($attendance->clock_out) {
                throw new \Exception('Anda sudah Clock Out hari ini.');
            }

            $this->attendanceRepo->update($attendance, [
                'clock_out' => now(),
            ]);

            $this->historyRepo->create([
                'employee_id' => $employee->id,
                'attendance_id' => $attendance->id,
                'date_attendance' => now()->toDateString(),
                'attendance_type' => self::CLOCK_OUT,
                'description' => 'Karyawan melakukan Clock Out pada ' . now()->format('H:i:s'),
            ]);

            DB::commit();
            return ['success' => true, 'message' => 'Clock Out berhasil.'];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Clock Out Error: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
