<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point',
        'week',
        'month',
        'state'
    ];

    public function getRanking($id){
        $collection = collect(Leaderboard::orderBy('point', 'DESC')->get());
        $data       = $collection->where('user_id', $id);
        $value      = $data->keys()->first() + 1;
        return $value;
     }
}
