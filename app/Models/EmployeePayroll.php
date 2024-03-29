<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayroll extends Model
{
    use HasFactory;

    protected $table = 'employee_payroll';

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'employee_id');
    }
}
