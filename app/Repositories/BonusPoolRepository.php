<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BonusPoolRepositoryInterface;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\BonusPool;

class BonusPoolRepository implements BonusPoolRepositoryInterface
{
    public function change(array $array){
        $result = BonusPool::find($array['id']);
        $result->update($array);
        return $result;
    }
}