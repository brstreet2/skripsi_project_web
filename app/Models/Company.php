<?php

namespace App\Models;

use App\Models\Auth\User;
use Carbon\Carbon;
use App\Models\CompanyEmployees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company';

    public function company_employees()
    {
        return $this->hasMany(CompanyEmployees::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'owner_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'company_id', 'id');
    }

    public function latest_announcements()
    {
        return $this->announcements()->latest('date');
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

    public function getDeletedAtAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }
}
