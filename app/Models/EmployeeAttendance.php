<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $table = 'employee_attendance';

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function attendance_detail()
    {
        return $this->hasMany(EmployeeAttendanceDetail::class, 'attendance_id', 'id');
    }
}
