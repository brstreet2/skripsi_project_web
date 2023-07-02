<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimeOff extends Model
{
    use HasFactory;

    protected $table = 'employee_timeoff';

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
}
