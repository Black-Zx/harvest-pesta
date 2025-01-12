<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    //state
    const unpublished = -1;
    const published = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'state',
        'photo_id',
        'created_by',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
