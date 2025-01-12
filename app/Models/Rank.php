<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    //rank
    const Member = 1;
    const Agent = 2;
    const Master_Agent = 3;
    const Shareholder = 4;
    const Master_Shareholder = 5;
}
