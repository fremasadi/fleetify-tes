<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'clock_in',
        'clock_out',
    ];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function histories()
    {
        return $this->hasMany(AttendanceHistory::class);
    }

    // Accessor untuk format tanggal
    public function getDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    // Accessor untuk format waktu clock in
    public function getClockInTimeAttribute()
    {
        return $this->clock_in ? $this->clock_in->format('H:i:s') : null;
    }

    // Accessor untuk format waktu clock out
    public function getClockOutTimeAttribute()
    {
        return $this->clock_out ? $this->clock_out->format('H:i:s') : null;
    }

    // Method untuk cek ketepatan clock in
    public function getClockInStatusAttribute()
    {
        if (!$this->clock_in || !$this->employee->departement) {
            return 'unknown';
        }

        $maxClockInTime = $this->employee->departement->max_clock_in_time;
        if (!$maxClockInTime) {
            return 'no_rule';
        }

        // Convert max_clock_in_time to today's datetime for comparison
        $maxTime = Carbon::parse($this->clock_in->format('Y-m-d') . ' ' . $maxClockInTime);
        
        if ($this->clock_in->lte($maxTime)) {
            return 'on_time';
        } else {
            return 'late';
        }
    }

    // Method untuk cek ketepatan clock out
    public function getClockOutStatusAttribute()
    {
        if (!$this->clock_out || !$this->employee->departement) {
            return 'unknown';
        }

        $maxClockOutTime = $this->employee->departement->max_clock_out_time;
        if (!$maxClockOutTime) {
            return 'no_rule';
        }

        // Convert max_clock_out_time to today's datetime for comparison
        $maxTime = Carbon::parse($this->clock_out->format('Y-m-d') . ' ' . $maxClockOutTime);
        
        if ($this->clock_out->lte($maxTime)) {
            return 'on_time';
        } else {
            return 'late';
        }
    }

    // Method untuk mendapatkan durasi kerja
    public function getWorkDurationAttribute()
    {
        if (!$this->clock_in || !$this->clock_out) {
            return null;
        }

        $duration = $this->clock_in->diff($this->clock_out);
        return $duration->format('%H:%I:%S');
    }

    // Method untuk mendapatkan keterlambatan clock in dalam menit
    public function getClockInLateMinutesAttribute()
    {
        if ($this->clock_in_status !== 'late' || !$this->employee->departement) {
            return 0;
        }

        $maxTime = Carbon::parse($this->clock_in->format('Y-m-d') . ' ' . $this->employee->departement->max_clock_in_time);
        return $this->clock_in->diffInMinutes($maxTime);
    }

    // Method untuk mendapatkan keterlambatan clock out dalam menit
    public function getClockOutLateMinutesAttribute()
    {
        if ($this->clock_out_status !== 'late' || !$this->employee->departement) {
            return 0;
        }

        $maxTime = Carbon::parse($this->clock_out->format('Y-m-d') . ' ' . $this->employee->departement->max_clock_out_time);
        return $this->clock_out->diffInMinutes($maxTime);
    }
}