<?php

namespace App\Http\Controllers\CustomerService;

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerService\BaseController;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Guarantee;
use App\Models\InsurancePoint;
use App\Models\UserProtectionHistory;
use Carbon\Carbon;

class ReportController extends BaseController {

    public function membersAndDownlinesReport(Request $request)
    {
        $total_insurance_point = 0;
        $total_bonus = 0;
        $total_direct_bonus = 0;
        $total_other_bonus = 0;
        $total_downline = 0;

        // if($request->filled('from') && $request->filled('to')) {
        //     $date_from = $request->from;
        //     $date_to = $request->to;
        // }else{
        //     $date_from = Carbon::now()->format('Y-m-d');
        //     $date_to = Carbon::now()->format('Y-m-d');
        // }

        $query = User::where('state',1);

        // if($request->filled('from') && $request->filled('to')) {
        //     $query = $query->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        // }
        if(!$request->filled('rank_id')) {
            $query = $query->where("rank_id",User::Master_Shareholder);
        }

        if($request->filled('username')) {
            $query = $query->where('username', 'like', '%'.$request->username.'%');
        }

        if($request->filled('name')) {
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->filled('email')) {
            $query = $query->where('email', 'like', '%'.$request->email.'%');
        }

        if($request->filled('contact_number')) {
            $query = $query->where('contact_number', 'like', '%'.$request->contact_number.'%');
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key => $user) {
            $tmp_total_bonus = 0;
            $tmp_total_insurancePoint = 0;
            $tmp_total_direct_bonus = 0;
            $tmp_total_other_bonus = 0;
            
            $user->rank = $user->rank?$user->rank->name:"-";
            $user->package = $user->package?$user->package->name:"-";
            $user->upper_line_user = $user->upper_line_user?$user->upper_line_user->name:"-";
            $user->downline = User::descendantsOf($user->id)->count();
            foreach (User::descendantsAndSelf($user->id) as $key => $value) {
                $tmp_total_bonus += $value->totalEarnBonus();
                $tmp_total_insurancePoint += $value->totalInsurancePoint();
                $tmp_total_direct_bonus += $value->bonuses()->BonusOther();
                $tmp_total_other_bonus += $value->bonuses()->BonusCommission();
            }

            $user->totalBonus = $tmp_total_bonus;
            $user->totalInsurancePoint = $tmp_total_insurancePoint;
            $user->other_bonus = $tmp_total_direct_bonus;
            $user->direct_bonus = $tmp_total_other_bonus;

            $total_insurance_point += $user->totalInsurancePoint;
            $total_bonus += $user->totalBonus;
            $total_direct_bonus += $user->direct_bonus;
            $total_other_bonus += $user->other_bonus;
            $total_downline += $user->downline;
        }

        $params = [
            'report' => $query,
            'total_insurance_point' => $total_insurance_point,
            'total_bonus' => $total_bonus,
            'total_direct_bonus' => $total_direct_bonus,
            'total_other_bonus' => $total_other_bonus,
            'total_downline' => $total_downline
            // 'date_from' => $date_from,
            // 'date_to' => $date_to
        ];

        return view('cs.reports.membersAndDownlinesReport', $params);
    }

    public function memberDownlinesReport(Request $request, $id)
    {
        $total_insurance_point = 0;
        $total_bonus = 0;
        $total_direct_bonus = 0;
        $total_other_bonus = 0;
        $total_downline = 0;

        // if($request->filled('from') && $request->filled('to')) {
        //     $date_from = $request->from;
        //     $date_to = $request->to;
        // }else{
        //     $date_from = Carbon::now()->format('Y-m-d');
        //     $date_to = Carbon::now()->format('Y-m-d');
        // }

        $descendants_user_id = User::find($id)->children()->pluck('id');

        $ancestors_user_id = User::defaultOrder()->ancestorsAndSelf($id)->pluck('id');

        $ancestors = User::where('state',1)->whereIn('id', $ancestors_user_id)->get();

        $query = User::where('state',1)->whereIn('id', $descendants_user_id);

        // if($request->filled('from') && $request->filled('to')) {
        //     $query = $query->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        // }

        if($request->filled('username')) {
            $query = $query->where('username', 'like', '%'.$request->username.'%');
        }

        if($request->filled('name')) {
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->filled('email')) {
            $query = $query->where('email', 'like', '%'.$request->email.'%');
        }

        if($request->filled('contact_number')) {
            $query = $query->where('contact_number', 'like', '%'.$request->contact_number.'%');
        }

        $query = $query->orderBy('upper_line_id','asc')->paginate(20);

        foreach ($query as $key => $user) {
            $tmp_total_bonus = 0;
            $tmp_total_insurancePoint = 0;
            $tmp_total_direct_bonus = 0;
            $tmp_total_other_bonus = 0;
            
            $user->rank = $user->rank?$user->rank->name:"-";
            $user->package = $user->package?$user->package->name:"-";
            $user->upper_line_user = $user->upper_line_user?$user->upper_line_user->name:"-";
            $user->downline = User::descendantsOf($user->id)->count();
            foreach (User::descendantsAndSelf($user->id) as $key => $value) {
                $tmp_total_bonus += $value->totalEarnBonus();
                $tmp_total_insurancePoint += $value->totalInsurancePoint();
                $tmp_total_direct_bonus += $value->bonuses()->BonusOther();
                $tmp_total_other_bonus += $value->bonuses()->BonusCommission();
            }

            $user->totalBonus = $tmp_total_bonus;
            $user->totalInsurancePoint = $tmp_total_insurancePoint;
            $user->other_bonus = $tmp_total_direct_bonus;
            $user->direct_bonus = $tmp_total_other_bonus;

            $total_insurance_point += $user->totalInsurancePoint;
            $total_bonus += $user->totalBonus;
            $total_direct_bonus += $user->direct_bonus;
            $total_other_bonus += $user->other_bonus;
            $total_downline += $user->downline;
        }

        $params = [
            'report' => $query,
            'ancestors' => $ancestors,
            'total_insurance_point' => $total_insurance_point,
            'total_bonus' => $total_bonus,
            'total_direct_bonus' => $total_direct_bonus,
            'total_other_bonus' => $total_other_bonus,
            'total_downline' => $total_downline
            // 'date_from' => $date_from,
            // 'date_to' => $date_to
        ];

        return view('cs.reports.memberDownlinesReport', $params);
    }

    public function insurancePointReport(Request $request)
    {
        $total_point = 0;
        $total_point_in = 0;
        $total_point_out = 0;

        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $user_ids = InsurancePoint::groupBy('user_id')->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->pluck('user_id');

        // return User::InsurancePointReports($date_from, $date_to, $user_ids)->get();
        // $query = User::where('state',1)->whereIn('id', $user_ids);
        $query = User::InsurancePointReports($date_from, $date_to, $user_ids);

        if($request->filled('username')) {
            $query = $query->where('users.username', 'like', '%'.$request->username.'%');
        }

        if($request->filled('name')) {
            $query = $query->where('users.name', 'like', '%'.$request->name.'%');
        }

        if($request->filled('email')) {
            $query = $query->where('users.email', 'like', '%'.$request->email.'%');
        }

        if($request->filled('contact_number')) {
            $query = $query->where('users.contact_number', 'like', '%'.$request->contact_number.'%');
        }

        if($request->filled('is_test') && $request->is_test != 2) {
            $query = $query->where('users.is_test', '=', $request->is_test);
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key => $user) {
            // $user->deposit = $user->insurance_points()->DateRangeDeposit($date_from, $date_to);
            // $user->withdraw = $user->insurance_points()->DateRangeWithdraw($date_from, $date_to);
            // $user->total = $user->deposit - $user->withdraw;
            $total_point = $total_point + $user->total;
            $total_point_in = $total_point_in + $user->deposit;
            $total_point_out = $total_point_out + $user->withdraw;
        }
        // return $query;

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_point' => $total_point,
            'total_point_in' => $total_point_in,
            'total_point_out' => $total_point_out
        ];

        return view('cs.reports.insurancePointReport', $params);
    }

    public function bonusReport(Request $request)
    {
        $total_point = 0;
        $total_point_in = 0;
        $total_point_out = 0;

        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $user_ids = Bonus::groupBy('user_id')->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->pluck('user_id');

        $query = User::where('state',1)->whereIn('id', $user_ids);

        if($request->filled('username')) {
            $query = $query->where('username', 'like', '%'.$request->username.'%');
        }

        if($request->filled('name')) {
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->filled('email')) {
            $query = $query->where('email', 'like', '%'.$request->email.'%');
        }

        if($request->filled('contact_number')) {
            $query = $query->where('contact_number', 'like', '%'.$request->contact_number.'%');
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key => $user) {
            $user->deposit = $user->bonuses()->DateRangeDeposit($date_from, $date_to);
            $user->withdraw = $user->bonuses()->DateRangeWithdraw($date_from, $date_to);
            $user->total = $user->deposit - $user->withdraw;
            $total_point = $total_point + $user->total;
            $total_point_in = $total_point_in + $user->deposit;
            $total_point_out = $total_point_out + $user->withdraw;
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_point' => $total_point,
            'total_point_in' => $total_point_in,
            'total_point_out' => $total_point_out
        ];

        return view('cs.reports.bonusReport', $params);
    }

    public function insurancePointReportById(Request $request, $id)
    {
        $total_point_deposit = 0;
        $total_point_withdraw = 0;

        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $query = InsurancePoint::where('user_id', $id)->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->with('user', 'payor_user', 'payee_user')->orderBy('id','desc')->paginate(20);

        foreach ($query as $key => $insurance_point) {
            switch ( $insurance_point->transaction_type ) {
                case InsurancePoint::purchase:
                    $insurance_point->transaction_type = "Purchase";
                    break;
                case InsurancePoint::transfer:
                    $insurance_point->transaction_type = "Transfer";
                    break;
                case InsurancePoint::insurancePointToBonus:
                    $insurance_point->transaction_type = "Insurance Point Covert To Bonus";
                    break;
                case InsurancePoint::bonusToInsurancePoint:
                    $insurance_point->transaction_type = "Bonus Convert To Insurance Point";
                    break;
                case InsurancePoint::payProtectionFees:
                    $insurance_point->transaction_type = "Pay Protection Fees";
                    break;
                case InsurancePoint::unpayProtectionFees:
                    $insurance_point->transaction_type = "Unpay Protection Fees";
                    break;
                
                default:
                    # code...
                    break;
            }
            $total_point_deposit = $total_point_deposit + $insurance_point->deposit;
            $total_point_withdraw = $total_point_withdraw  + $insurance_point->withdraw;
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_point_in' => $total_point_deposit,
            'total_point_out' => $total_point_withdraw,
        ];

        return view('cs.reports.insurancePointReportById', $params);
    }

    public function bonusReportById(Request $request, $id)
    {
        $total_point_deposit = 0;
        $total_point_withdraw = 0;

        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $query = Bonus::where('user_id', $id)->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        
        if($request->filled('type') && $request->type != "-") {
            $query = $query->where('transaction_type', $request->type);
        }

        $query = $query->with('user', 'payor_user', 'payee_user')->orderBy('id','desc');

        foreach ($query->get() as $key => $insurance_point) {
            $total_point_deposit = $total_point_deposit + $insurance_point->deposit;
            $total_point_withdraw = $total_point_withdraw  + $insurance_point->withdraw;
        }

        // $query = Bonus::where('user_id', $id)->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"])->with('user', 'payor_user', 'payee_user')->orderBy('id','desc')->paginate(20);
        $query = $query->paginate(20);

        foreach ($query as $key => $insurance_point) {
            switch ( $insurance_point->transaction_type ) {
                case Bonus::withdraw:
                    $insurance_point->transaction_type = "Withdraw";
                    break;
                case Bonus::insurancePointToBonus:
                    $insurance_point->transaction_type = "Insurance Point Covert To Bonus";
                    break;
                case Bonus::bonusToInsurancePoint:
                    $insurance_point->transaction_type = "Bonus Convert To Insurance Point";
                    break;
                case Bonus::earn:
                    $insurance_point->transaction_type = "Earn";
                    break;
                case Bonus::commission:
                    $insurance_point->transaction_type = "Direct Sponsor Point";
                    break;
                case Bonus::other:
                    $insurance_point->transaction_type = "Other Point";
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_point_in' => $total_point_deposit,
            'total_point_out' => $total_point_withdraw,
        ];

        return view('cs.reports.bonusReportById', $params);
    }

    public function membersWithdrawReport(Request $request)
    {
        $total_withdraw = 0;

        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $query = Bonus::where("transaction_type", Bonus::withdraw)->with('user', 'bank');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        }

        if($request->filled('username')) {
            $user_id = User::where('username', 'like', '%'.$request->username.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('name')) {
            $user_id = User::where('name', 'like', '%'.$request->name.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('email')) {
            $user_id = User::where('email', 'like', '%'.$request->email.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('contact_number')) {
            $user_id = User::where('contact_number', 'like', '%'.$request->contact_number.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('state') && $request->state != "-") {
            $query = $query->where('state', $request->state);
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key => $bonus) {
            $bonus->username = $bonus->user?$bonus->user->username:"-";
            $bonus->name = $bonus->user?$bonus->user->name:"-";
            $bonus->email = $bonus->user?$bonus->user->email:"-";
            $bonus->contact_number = $bonus->user?$bonus->user->contact_number:"-";
            $bonus->bank_name = $bonus->bank?$bonus->bank->name:"-";
            
            $total_withdraw += $bonus->withdraw;
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_withdraw' => $total_withdraw
        ];

        return view('cs.reports.membersWithdrawReport', $params);
    }

    public function guaranteeClaimReport(Request $request)
    {
        $total_request_amount = 0;
        $total_final_verify_amount = 0;
        
        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $query = Guarantee::with('user');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        }

        if($request->filled('username')) {
            $user_id = User::where('username', 'like', '%'.$request->username.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('name')) {
            $user_id = User::where('name', 'like', '%'.$request->name.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('email')) {
            $user_id = User::where('email', 'like', '%'.$request->email.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('contact_number')) {
            $user_id = User::where('contact_number', 'like', '%'.$request->contact_number.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key =>$guarantee) {
            $guarantee->username =$guarantee->user?$guarantee->user->username:"-";
            $guarantee->name =$guarantee->user?$guarantee->user->name:"-";
            $guarantee->email =$guarantee->user?$guarantee->user->email:"-";
            $guarantee->contact_number =$guarantee->user?$guarantee->user->contact_number:"-";

            $total_request_amount += $guarantee->withdraw;
            $total_final_verify_amount += $guarantee->final_verify_amount;
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_request_amount' => $total_request_amount,
            'total_final_verify_amount' => $total_final_verify_amount
        ];

        return view('cs.reports.guaranteeClaimReport', $params);
    }

    public function protectionReport(Request $request)
    {   
        if($request->filled('from') && $request->filled('to')) {
            $date_from = $request->from;
            $date_to = $request->to;
        }else{
            $date_from = Carbon::now()->format('Y-m-d');
            $date_to = Carbon::now()->format('Y-m-d');
        }

        $query = UserProtectionHistory::with('user');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('start_at', [$date_from. " 00:00:00", $date_to. " 23:59:59"]);
        }

        if($request->filled('username')) {
            $user_id = User::where('username', 'like', '%'.$request->username.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('name')) {
            $user_id = User::where('name', 'like', '%'.$request->name.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('email')) {
            $user_id = User::where('email', 'like', '%'.$request->email.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        if($request->filled('contact_number')) {
            $user_id = User::where('contact_number', 'like', '%'.$request->contact_number.'%')->pluck('id');
            $query = $query->whereIn('user_id', $user_id);
        }

        $query = $query->orderBy('id','desc')->paginate(20);

        foreach ($query as $key =>$protection) {
            $protection->username =$protection->user?$protection->user->username:"-";
            $protection->name =$protection->user?$protection->user->name:"-";
            $protection->email =$protection->user?$protection->user->email:"-";
            $protection->contact_number =$protection->user?$protection->user->contact_number:"-";
            $protection->apps_username =$protection->user?$protection->user->apps_username:"-";
        }

        $params = [
            'report' => $query,
            'date_from' => $date_from,
            'date_to' => $date_to
        ];

        return view('cs.reports.protectionReport', $params);
    }
    
}