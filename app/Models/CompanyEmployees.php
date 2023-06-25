<?php

namespace App\Models;

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEmployees extends Model
{
    use HasFactory;

    protected $table = 'company_employees';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }
}
