<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDateSlot extends Model
{
    use HasFactory;

    // protected $guard = 'admin';
    protected $fillable = [
        'date_time_slot_id',
        'customer_id',
        'checkin',
        'checkin_time'
    ];

    function customer(){
        return $this->belongsTo(Customer::class);
    } 

    function date_slot(){
        return $this->belongsTo(DateTimeSlot::class, 'date_time_slot_id');
    } 
}
