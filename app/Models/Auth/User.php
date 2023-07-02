<?php

namespace App\Models\Auth;

use App\Models\Company;
use App\Models\CompanyEmployees;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeTimeOff;
use App\Models\UserCompany;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends EloquentUser implements AuthenticatableUserContract, AuthenticatableContract // implements JWTSubject // Authenticatable implements JWTSubject
{
    use Authenticatable, HasApiTokens, SoftDeletes;
    const last_login = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type',
        'created_by'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function user_role()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id');
    }

    public function company_employees()
    {
        return $this->hasOne(CompanyEmployees::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(EmployeeAttendance::class, 'employee_id', 'id');
    }

    public function time_off()
    {
        return $this->hasMany(EmployeeTimeOff::class, 'employee_id', 'id');
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

    public function getLastLoginAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }

    public function getOtpExpiredAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return (new Carbon($value))->timezone('Asia/Jakarta')->toDateTimeString();
        }
    }

    public function getTokenAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return $value;
        }
    }

    public function getPermissionsAttribute($value)
    {
        if ($value == null) {
            return '';
        } else {
            return $value;
        }
    }
}
