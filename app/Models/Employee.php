<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'departement_id',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function attendanceHistories()
    {
        return $this->hasMany(AttendanceHistory::class, 'employee_id');
    }

   
}