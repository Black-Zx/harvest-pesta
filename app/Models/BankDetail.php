<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{

    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'bank_id',
        'bank_account',
        'bank_account_name',
        'state',
        'created_by',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
