<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'game'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
