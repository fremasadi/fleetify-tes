<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use App\Repositories\AttendanceRepository;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceHistory;
use Illuminate\Support\Facades\Auth;
class AttendanceController extends Controller
{
    protected $attendanceService;
    protected $attendanceRepo;

    public function __construct(AttendanceService $attendanceService, AttendanceRepository $attendanceRepo)
    {
        $this->attendanceService = $attendanceService;
        $this->attendanceRepo = $attendanceRepo;
    }

    public function index(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $query = $this->attendanceRepo->getAllWithRelations();

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }
            if ($request->filled('departement_id')) {
                $query->whereHas('employee', fn($q) => $q->where('departement_id', $request->departement_id));
            }

            $attendances = $query->latest()->get();
            $departements = Departement::all();
        } else {
            $attendances = $this->attendanceRepo->getByEmployee(auth()->user()->employee->id);
            $departements = collect();
        }

        return view('attendances.index', compact('attendances', 'departements'));
    }

    public function clockIn()
    {
        $employee = auth()->user()->employee;
        $result = $this->attendanceService->clockIn($employee);

        return redirect()->back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function clockOut()
    {
        $employee = auth()->user()->employee;
        $result = $this->attendanceService->clockOut($employee);

        return redirect()->back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

   public function showClockPage()
{
    $employee = auth()->user()->employee->load('departement');
    $todayAttendance = $this->attendanceRepo->findTodayByEmployee($employee->id);

    return view('attendances.clock-attendance', compact('todayAttendance', 'employee'));
}


    public function historyIndex()
{
    if (auth()->user()->role === 'admin') {
        // Admin melihat semua history
        $histories = $this->attendanceRepo->getAllHistories();
    } else {
        // Karyawan hanya melihat history sendiri
        $histories = $this->attendanceRepo->getHistoriesByEmployee(auth()->user()->employee->id);
    }

    return view('attendances.history', compact('histories'));
}

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        // Validasi khusus format jam:menit
        $request->validate([
            'clock_in'  => 'required|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i',
        ]);

        // Ambil tanggal dari attendance (supaya jam nempel ke hari yg benar)
        $date = $attendance->created_at->format('Y-m-d');

        // Gabungkan tanggal + jam dari input
        $attendance->clock_in = $date . ' ' . $request->clock_in . ':00';
        $attendance->clock_out = $request->clock_out 
            ? $date . ' ' . $request->clock_out . ':00'
            : null;

        $attendance->save();

        // ✅ Update history terakhir agar ditandai sudah diedit admin
        $lastHistory = AttendanceHistory::where('attendance_id', $attendance->id)
            ->latest()
            ->first();

        if ($lastHistory) {
            $lastHistory->update([
                'description' => $lastHistory->description . ' | Diedit oleh admin: ' . Auth::user()->name,
            ]);
        }

        return redirect()->route('attendances.index')
            ->with('success', 'Absensi berhasil diperbarui (diedit oleh admin).');
    }
}
