<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'message',
        'type',
        'url'
    ];

    public function customer_services()
    {
        return $this->belongsToMany(User::class, 'customer_service_notifications')->withTimestamps();
    }
}
