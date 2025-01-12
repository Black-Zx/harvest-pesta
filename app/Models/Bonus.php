<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bonus extends Model
{
    use HasFactory;
    
    //transaction_type value
    const withdraw = 1;
    const insurancePointToBonus = 2;
    const bonusToInsurancePoint = 3;
    const earn = 4;
    const commission = 5;
    const other = 6;

    //state value
    const pending = 0;
    const approved = 1;
    const rejected = -1;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bank_id',
        'bank_account',
        'bank_account_name',
        'approved_by',
        'deposit',
        'withdraw',
        'state',
        'transaction_type',
        'week_num',
        'payment_date',
        'remark'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deposit' => 'decimal:2',
        'withdraw' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function scopeEarnedBonus($query, $week_num) {
        if ($week_num == 0) {
            return $query->where('state',1)->whereIn('transaction_type', [4,5,6])->sum('deposit');
        }else{
            return $query->where('state',1)->whereIn('transaction_type', [4,5,6])->where('week_num',$week_num)->sum('deposit');
        }
    }

    public function scopeBonusCommission($query) {
        return $query->where('state',1)->whereIn('transaction_type', [5])->sum('deposit');
    }

    public function scopeBonusCommissionMonthly($query) {
        return $query->where('state',1)->whereIn('transaction_type', [4,5,6])->whereMonth('created_at', Carbon::now()->month)->sum('deposit');
    }

    public function scopeBonusOther($query) {
        return $query->where('state',1)->whereIn('transaction_type', [6])->sum('deposit');
    }

    public function payor_user()
    {
        return $this->belongsTo(User::class, 'payor_user_id');
    }

    public function payee_user()
    {
        return $this->belongsTo(User::class, 'payee_user_id');
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
