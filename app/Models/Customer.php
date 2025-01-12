<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nickname',
        'nric',
        'email',
        'mobile',
        'qr_code',
        'unique_code',
        'qr_code_guest',
        'unique_code_guest',
        'check_in',
        'check_in_guest',
        'check_out',
        'guest'
    ];

    protected $touches = ['date_time_slots'];

    public function checked_in()
    {
        return $this->where('check_in', NULL);
    }

    public function total()
    {
        return $this->count();
    }

    public function date_time_slots()
    {
        return $this->belongsToMany(DateTimeSlot::class, 'customer_date_slots', 'customer_id', 'date_time_slot_id')->withTimestamps();
    }

    public function date_time_slot_latest_record()
    {
        return $this->belongsToMany(DateTimeSlot::class, 'customer_date_slots', 'customer_id', 'date_time_slot_id')->latest();
    }

    public function redemption($date = ""){
        if ($date) {
            return $this->hasMany(Redemption::class)->whereDate('created_at', $date);
        }else{
            return $this->hasMany(Redemption::class);
        }
    }

    public function redemption_time(){
        return $this->hasMany(Redemption::class, "customer_id")->latest();
    }
}
