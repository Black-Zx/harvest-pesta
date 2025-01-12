<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateTimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'date',
        'time_slot',
        'slot',
        'slot_used',
        'ordering'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_date_slots', 'date_time_slot_id', 'customer_id');
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    protected $casts = [
        'date' => 'datetime:l, d F Y',
     ];
}
