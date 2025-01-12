<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Auth;
use DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'username',
        'contact_number',
        'gender',
        'dob',
        'upper_line_id',
        'bank_id',
        'bank_account',
        'state',
        'apps_username',
        'bank_account_name',
        '_lft',
        '_rgt',
        'rank_id',
        'block',
        'line_account'
    ];

    //state value
    const pending = 0;
    const approved = 1;
    const rejected = -1;

    //rank
    const Member = 1;
    const Agent = 2;
    const Master_Agent = 3;
    const Shareholder = 4;
    const Master_Shareholder = 5;

    //protection state
    const unprotect = 0;
    const protect = 1;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function totalInsurancePoint()
    {
        $deposit = $this->hasMany(InsurancePoint::class)->where('state',1)->sum('deposit');
        $withdraw = $this->hasMany(InsurancePoint::class)->where('state',1)->sum('withdraw');
        return $deposit - $withdraw;
    }

    public function totalBonus()
    {
        $deposit = $this->hasMany(Bonus::class)->where('state',1)->sum('deposit');
        $withdraw = $this->hasMany(Bonus::class)->where('state',1)->sum('withdraw');
        return  $deposit - $withdraw;
    }

    public function totalEarnInsurancePoint()
    {
        $deposit = $this->hasMany(InsurancePoint::class)->where('state',1)->sum('deposit');
        $withdraw = $this->hasMany(InsurancePoint::class)->where('state',1)->sum('withdraw');
        return $deposit - $withdraw;
    }

    public function totalEarnBonus()
    {
        $deposit = $this->hasMany(Bonus::class)->where('state',1)->whereIn('transaction_type',[4,5,6])->sum('deposit');
        $withdraw = $this->hasMany(Bonus::class)->where('state',1)->whereIn('transaction_type',[4,5,6])->sum('withdraw');
        return  $deposit - $withdraw;
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function insurance_points()
    {
        return $this->hasMany(InsurancePoint::class);
    }

    public function packageInsurancePoint()
    {
        return $this->belongsTo(Package::class)->select('insurance_point');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function packages()
    {
        return $this->hasMany(PackageUser::class)->whereNull('deleted_at');
    }

    public function upper_line_user()
    {
        return $this->belongsTo(User::class, 'upper_line_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function getParentIdName()
    {
        return 'upper_line_id';
    }

    public function scopeRankCount($query, $rank_id) {
        return $query->descendantsOf(Auth::user()->id)->where('state', 1)->where('rank_id', $rank_id)->count();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function protection_expired_date()
    {
        return $this->hasMany(UserProtectionHistory::class)->orderBy('created_at', 'desc')->first();
    }

    public function protection_created_date()
    {
        return $this->hasMany(UserProtectionHistory::class)->orderBy('created_at', 'desc')->first();
    }

    public function scopeInsurancePointReports($query, $date_from, $date_to, $user_ids)
    {
        $query->join('insurance_points', function($join) use ($date_from, $date_to)
        {
            $join->on('users.id', '=', 'insurance_points.user_id')->whereBetween('insurance_points.created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->where('insurance_points.state',1);
        });
        $query = $query->whereIn('users.id', $user_ids);
        $query = $query->groupBy('users.id');
        $query = $query->orderBy('deposit', 'desc');

        return $query->select(
            'users.*',
            DB::raw('sum(insurance_points.deposit) as deposit'),
            DB::raw('sum(insurance_points.withdraw) as withdraw'),
            DB::raw('sum(insurance_points.deposit - insurance_points.withdraw) as total')
        );
    }

    public function getRanking(){
        $collection = collect(Leaderboard::orderBy('point', 'DESC')->get());
        $data       = $collection->where('user_id', $this->id);
        $value      = $data->keys()->first() + 20;
        return $value;
     }
}
