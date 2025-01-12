<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUserHistory extends Model
{
    use HasFactory;
    protected $table = 'package_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'policy_number',
        'deleted_by',
        'updated_by'
    ];

    public function package()
    {
        return $this->hasOne(Package::class);
    }
}
