<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Departement;
use App\Models\AttendanceHistory;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalEmployees   = Employee::count();
            $todayAttendances = Attendance::whereDate('created_at', today())->count();
            $totalDepartments = Departement::count();
            $latestHistories  = AttendanceHistory::with('employee.user')
                                ->latest()
                                ->take(5)
                                ->get();

            return view('dashboard', compact(
                'totalEmployees',
                'todayAttendances',
                'totalDepartments',
                'latestHistories'
            ));
        }

        // karyawan
        $employee = $user->employee()->with('departement')->first();
        $todayAttendance = Attendance::where('employee_id', $employee->id)
                                ->whereDate('created_at', today())
                                ->first();

        return view('dashboard', compact('employee', 'todayAttendance'));
    }
}
