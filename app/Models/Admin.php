<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, Notifiable, HasApiTokens;
    // protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
