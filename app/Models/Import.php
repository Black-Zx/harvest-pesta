<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    //state value
    const pending = 0;
    const processed = 1;
    const error = -1;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'week',
        'point',
        'casino_name',
        'imported_by',
        'state'
    ];

}
