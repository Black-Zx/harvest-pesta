<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ImportRecordRepositoryInterface;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Import;
use App\Models\Bonus;
use App\Models\ImportDirectBonus;
use App\Imports\UsersEarning;
use App\Imports\UsersDirectPoint;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\BindImportWithSales;

class ImportRecordRepository implements ImportRecordRepositoryInterface
{
    public function store(array $array, string $file_name, int $file_size, string $path, string $type){

        try {
            DB::transaction(function() use($array, $path, $type) {     
                if($type == "casino"){
                    \Excel::import(new UsersEarning(),$path);
                }elseif ($type == "direct bonus") {
                    \Excel::import(new UsersDirectPoint($array['month'], $array['year']),$path);
                }
            });
          } catch (\Exception $e) {
                return "Error";
          }
          return "Success";

    }

    public function bind(){
        $result = Import::where('state', Import::pending)->where('point','<>',null)->get();
        foreach($result as $key => $value) {
            $user = User::where('username', $value->username)->first();
            if ($user) {
                $user->casino = $value->point;
                $user->casino_name = $value->casino_name;
                $user->save();
                $value->state = 1;
                $value->save();
            }else{
                $value->state = -1;
                $value->save();
            }
        }
        return $result;
    }

    public function bindDirectBonus(string $month, string $year){
        $result = ImportDirectBonus::where('state', ImportDirectBonus::pending)->where('point','<>',null)->get();
        foreach($result as $key => $value) {
            $user = User::where('username', $value->username)->first();
            if ($user) {
                $bonus = Bonus::where('user_id', $user->id)->where('month', $month)->where('year', $year)->where('transaction_type', Bonus::commission)->first();
                if (!$bonus) {
                    $bonus = new Bonus;
                }
                $bonus->user_id = $user->id;
                $bonus->approved_by = Auth::user()->id;
                $bonus->deposit = $value->point;
                $bonus->transaction_type = Bonus::commission;
                $bonus->state = 1;
                $bonus->week_num = Carbon::now()->weekOfYear;        
                $bonus->month = $month;        
                $bonus->year = $year;        
                $bonus->save();
                $value->state = 1;
                $value->bonus_id = $bonus->id;
                $value->save();
            }else{
                $value->state = -1;
                $value->save();
            }
        }
        return $result;
    }
}