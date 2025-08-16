<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceHistory extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_id',
        'date_attendance',
        'attendance_type',
        'description'
    ];

    protected $casts = [
        'date_attendance' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class);
    }

    // Accessor untuk format tanggal yang readable
    public function getFormattedDateAttribute()
    {
        return $this->date_attendance->format('d M Y');
    }

    // Accessor untuk format waktu created
    public function getTimeAttribute()
    {
        return $this->created_at->format('H:i:s');
    }

    public function getBadgeClassAttribute()
{
    return match($this->attendance_type) {
        'clock_in', AttendanceService::CLOCK_IN => 'badge-success',
        'clock_out', AttendanceService::CLOCK_OUT => 'badge-danger',
        'edit' => 'badge-warning',
        default => 'badge-info'
    };
}

    public function getIconAttribute()
{
    return match($this->attendance_type) {
        'clock_in', AttendanceService::CLOCK_IN => 'fas fa-sign-in-alt',
        'clock_out', AttendanceService::CLOCK_OUT => 'fas fa-sign-out-alt',
        'edit' => 'fas fa-user-edit',
        default => 'fas fa-clock'
    };
}

}