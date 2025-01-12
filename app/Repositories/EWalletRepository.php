<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EWalletRepositoryInterface;
use App\Models\InsurancePoint;
use App\Models\Bonus;
use App\Models\User;
use App\Models\Guarantee;
use App\Models\UserProtectionHistory;
use App\Models\PackageUser;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EWalletRepository implements EWalletRepositoryInterface
{
    public function addByAdmin(array $array){
        $result = new InsurancePoint;
        $result->user_id = $array['id'];
        $result->deposit = $array['deposit'];
        $result->transaction_type = InsurancePoint::purchase;
        $result->week_num = Carbon::now()->weekOfYear;
        $result->approved_by = Auth::user()->id;
        $result->approved_at = Carbon::now();
        $result->state = 1;
        $result->save();
        return $result;
    }

    public function purchase(array $array){
        $result = new InsurancePoint;
        $result->user_id = Auth::user()->id;
        $result->deposit = $array['deposit'];
        // $result->photo_array = json_encode($array['photo_array']);
        $result->transaction_type = InsurancePoint::purchase;
        $result->week_num = Carbon::now()->weekOfYear;
        $result->save();
        return $result;
    }

    public function claim(array $array){
        $result = new Guarantee;
        $result->user_id = Auth::user()->id;
        $result->withdraw = $array['amount'];
        $result->apps_username = Auth::user()->apps_username;
        $result->photo_array = json_encode($array['photo_array']);
        $result->week_num = Carbon::now()->weekOfYear;
        $result->remark = $array['remark'];
        $result->save();
        return $result;
    }

    public function convert(array $array){
        if ($array['type'] == InsurancePoint::insurancePointToBonus) {

            $result = new InsurancePoint;
            $resultB = new Bonus;

            DB::transaction(function() use( $array, $result, $resultB ) {
                $result->user_id = Auth::user()->id;
                $result->withdraw = $array['amount'];
                $result->transaction_type = InsurancePoint::insurancePointToBonus;
                $result->state = 1;
                $result->week_num = Carbon::now()->weekOfYear;
                $result->save();

                $resultB->user_id = Auth::user()->id;
                $resultB->deposit = $array['amount'];
                $resultB->transaction_type = Bonus::insurancePointToBonus;
                $resultB->state = 1;
                $result->week_num = Carbon::now()->weekOfYear;
                $resultB->save();
            });
            return $result;

        }else if($array['type'] == InsurancePoint::bonusToInsurancePoint){
            
            $result = new InsurancePoint;
            $resultB = new Bonus;
            
            DB::transaction(function() use( $array, $result, $resultB ) {

                $result->user_id = Auth::user()->id;
                $result->deposit = $array['amount'];
                $result->transaction_type = InsurancePoint::bonusToInsurancePoint;
                $result->state = 1;
                $result->week_num = Carbon::now()->weekOfYear;
                $result->save();

                $resultB->user_id = Auth::user()->id;
                $resultB->withdraw = $array['amount'];
                $resultB->transaction_type = Bonus::bonusToInsurancePoint;
                $resultB->state = 1;
                $result->week_num = Carbon::now()->weekOfYear;
                $resultB->save();
            });
            return $result;

        }
    }

    public function transfer(array $array){
        
        $result = new InsurancePoint;
        $result->user_id = Auth::user()->id;
        $result->payor_user_id = Auth::user()->id;
        $result->payee_user_id = $array['payee_user_id'];
        $result->withdraw = $array['amount'];
        $result->transaction_type = InsurancePoint::transfer;
        $result->week_num = Carbon::now()->weekOfYear;
        $result->state = 1;
        $result->save();

        $result = new InsurancePoint;
        $result->user_id = $array['payee_user_id'];
        $result->payor_user_id = Auth::user()->id;
        $result->payee_user_id = $array['payee_user_id'];
        $result->deposit = $array['amount'];
        $result->transaction_type = InsurancePoint::transfer;
        $result->week_num = Carbon::now()->weekOfYear;
        $result->state = 1;
        $result->save();
        return $result;
    }

    public function approve(array $array, string $type){
        switch ($type) {
            case 'InsurancePoint':
                $result = InsurancePoint::find($array['id']);
                $result->remark = $array['remark'];
                break;
            case 'Bonus':
                $result = Bonus::find($array['id']);
                $result->remark = $array['remark'];
                $result->payment_date = Carbon::now();
                break;
            case 'User':
                $result = User::find($array['id']);
                if ($array['state'] == 1) {
                    $result->apps_username = $array['apps_username'];
                }else{
                    $result->apps_username = "-";
                    $result->username = $result->username.'_rejected_'.Carbon::now()->timestamp;
                }
                break;
            case 'Guarantee':
                $result = Guarantee::find($array['id']);
                $result->final_verify_amount = $array['final_verify_amount'];
                $result->remark = $array['remark'];
                break;
            default:
                # code...
                break;
        }
        $result->approved_by = Auth::user()->id;
        $result->approved_at = Carbon::now();
        $result->state = $array['state'];
        $result->save();
        return $result;
    }

    public function withdraw(array $array){
        $result = new Bonus;
        $result->user_id = Auth::user()->id;
        $result->withdraw = $array['amount'];
        $result->bank_id = Auth::user()->bank_id;
        $result->bank_account = Auth::user()->bank_account;
        $result->bank_account_name = Auth::user()->bank_account_name;
        $result->transaction_type = Bonus::withdraw;
        $result->week_num = Carbon::now()->weekOfYear;        
        $result->save();
        return $result;
    }

    public function create(array $array){
        $result = new Bonus;
        $result->user_id = $array['user_id'];
        $result->approved_by = Auth::user()->id;
        $result->deposit = $array['deposit'];
        $result->transaction_type = $array['type'];
        $result->state = 1;
        $result->week_num = Carbon::now()->weekOfYear;        
        $result->save();
        return $result;
    }

    public function pay(array $array){
       
        $result = new InsurancePoint;
        $result->user_id = $array['user_id'];
        $result->withdraw = $array['pay'];
        $result->policy_number = $array['policy_number'];
        $result->week_num = Carbon::now()->weekOfYear;
        $result->transaction_type = $array['able_pay'] == 1 ? InsurancePoint::payProtectionFees : InsurancePoint::unpayProtectionFees;
        $result->state = 1;
        $result->save();

        $user = User::where("id", $array['user_id'])->first();
        $package_user = PackageUser::where('policy_number', $array['policy_number'])->first();
        $date = NULL;
        $days = 0;

        if($array['pay'])
        {
            $date = Carbon::now()->addDays( (int)($array['user_total_insurance_point'] / $array['pay']) )->format('Y-m-d H:i:s');
            $days = (int)($array['user_total_insurance_point'] / $array['pay']);
        }else{
            $date = Carbon::now()->addDays( 0 )->format('Y-m-d H:i:s');
        }

        if ($array['able_pay']) {
            $package_user->protected_start_at = $package_user->protected_start_at == NULL ? Carbon::now() : $package_user->protected_start_at;
            $package_user->protected_end_at = $date;
            $package_user->days = $days;
            $user->protection_state = User::protect;
        }else{
            $package_user->protected_start_at = NULL;
            $package_user->protected_end_at = $date;
            $package_user->days = $days;
            $user->protection_state = User::unprotect;
        }
        
        $package_user->save();
        $user->save();

        return $result;
    }

    
}