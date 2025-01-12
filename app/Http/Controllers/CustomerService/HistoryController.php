<?php

namespace App\Http\Controllers\CustomerService;

use App\Http\Controllers\CustomerService\BaseController;
use Illuminate\Http\Request;
use App\Models\Guarantee;
use App\Models\InsurancePoint;
use App\Models\User;
use App\Models\Bonus;
use Illuminate\Support\Facades\Auth;

class HistoryController extends BaseController {

    public function showGuarantee(Request $request)
    {
        $query = Guarantee::with('user')->where('approved_by', Auth::user()->id);

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('approved_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        $params = [
            'guarantees' => $query,
        ];

        return view('cs.history.guarantee', $params);
    }  

    public function showWithdrawal(Request $request)
    {
        $query = Bonus::where("transaction_type", Bonus::withdraw)->with('user')->where('approved_by', Auth::user()->id);

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('approved_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        $params = [
            'withdrawals' => $query,
        ];

        return view('cs.history.withdrawal', $params);
    } 

    public function showMembership(Request $request)
    {
        $query = User::where('approved_by', Auth::user()->id)->with('bank');

        
        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('approved_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        foreach ($query as $key => $value) {
            $tmp = explode("_",$value->username);
            if (count($tmp)>1) {
                $value->username = $tmp[1]=="rejected"?$tmp[0]:$value->username;
            }
        }

        $params = [
            'memberships' => $query,
        ];

        return view('cs.history.membership', $params);
    } 

    public function showInsurance(Request $request)
    {

        $query = InsurancePoint::where("transaction_type", InsurancePoint::purchase)->with('user')->where('approved_by', Auth::user()->id);

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('approved_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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
        $params = [
            'insurances' =>$query
        ];

        return view('cs.history.insurance', $params);
    }

}