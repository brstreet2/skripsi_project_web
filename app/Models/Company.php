<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company';

    public function user_company()
    {
        return $this->hasMany(UserCompany::class, 'company_id', 'id');
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
