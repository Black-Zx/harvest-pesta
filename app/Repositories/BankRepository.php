<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BankRepositoryInterface;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\BankDetail;

class BankRepository implements BankRepositoryInterface
{
    public function change(array $array){
        $result = BankDetail::find(1);
        $result->created_by = Auth::user()->id;
        $result->update($array);
        return $result;
    }
}