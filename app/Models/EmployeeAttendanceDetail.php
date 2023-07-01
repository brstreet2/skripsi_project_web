<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceDetail extends Model
{
    use HasFactory;

    protected $table = 'employee_attendance_detail';

    public function attendance()
    {
        return $this->belongsTo(EmployeeAttendance::class, 'id', 'attendance_id');
    }
}
