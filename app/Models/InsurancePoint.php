<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePoint extends Model
{
    use HasFactory;

    //transaction_type value
    const purchase = 1;
    const transfer = 2;
    const withdraw = 3;
    const insurancePointToBonus = 4;
    const bonusToInsurancePoint = 5;
    const payProtectionFees = 6;
    const unpayProtectionFees = 7;

    //state value
    const pending = 0;
    const approved = 1;
    const rejected = -1;

    //approve list
    const purchaseInsurancePoint = 1;
    const withdrawBonus = 2;
    const registerMember = 3;
    const guaranteeClaim = 4;

     //report value
     const purchaseReport = 1;
     const transferReport = 2;
     const withdrawReport = 3;
     const bonusReport = 4;
     const guaranteeReport = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'approved_by', 'deposit', 'withdraw', 'type', 'transaction_type', 'payee_user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'photo_array' => 'array',
    ];

    public function payor_user()
    {
        return $this->belongsTo(User::class, 'payor_user_id');
    }

    public function payee_user()
    {
        return $this->belongsTo(User::class, 'payee_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeWithdraw($query) {
        return $query->where('state',1)->sum('withdraw');
    }

    public function scopeDeposit($query) {
        return $query->where('state',1)->sum('deposit');
    }

    public function scopeDairyWithdraw($query, $date) {
        return $query->where('state',1)->whereDate('created_at', '=', $date)->sum('withdraw');
    }

    public function scopeDairyDeposit($query, $date) {
        return $query->where('state',1)->whereDate('created_at', '=', $date)->sum('deposit');
    }

    public function scopeDateRangeWithdraw($query, $date_from, $date_to) {
        return $query->where('state',1)->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->sum('withdraw');
    }

    public function scopeDateRangeDeposit($query, $date_from, $date_to) {
        return $query->where('state',1)->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->sum('deposit');
    }

}
