<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerServiceNotifications extends Model
{
    protected $fillable = [
        'is_used'
    ];

    function notification(){
        return $this->hasOne(Notification::class, 'id', 'notification_id');
    } 

    function customer_service(){
        return $this->hasOne(CustomerService::class);
    }       
}
