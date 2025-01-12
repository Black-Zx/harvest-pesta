<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;
    // minute
    const expireTime = 15;

    //type
    const csLogin = 1;
    const adminLogin = 2;
    const editUser = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username',
        'otp_code',
        'entered_code',
        'email_status',
        'type',
        'expired_at',
        'keyed_in_at',
    ];

    public function scopeNotExpired($query)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return $query->where('expired_at', '>=', $now);
    }

    public function scopeByIsUsedStatus($query, $status)
    {
        return $query->where('used_status', $status);
    }

    public function scopeByOtpCode($query, $code)
    {
        return $query->where('otp_code', $code);
    }
}
