<?php

namespace App\Http\Controllers\CustomerService;

use App\Http\Controllers\CustomerService\BaseController;
use Illuminate\Http\Request;
use App\Models\Guarantee;
use App\Models\InsurancePoint;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Rank;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApprovalController extends BaseController {

    public function showGuarantee(Request $request)
    {
        $query = Guarantee::where("state", InsurancePoint::pending)->with('user');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        return view('cs.approval.guarantee', $params);
    }  

    public function showWithdrawal(Request $request)
    {
        $query = Bonus::where("transaction_type", Bonus::withdraw)->where("state", Bonus::pending)->with('user');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        return view('cs.approval.withdrawal', $params);
    } 

    public function showMembership(Request $request)
    {
        $query = User::where("state", User::pending)->with('bank');

        
        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        $params = [
            'memberships' => $query,
        ];

        return view('cs.approval.membership', $params);
    } 

    public function showInsurance(Request $request)
    {
        $query = InsurancePoint::where("transaction_type", InsurancePoint::purchase)->where("state", InsurancePoint::pending)->with('user');

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        return view('cs.approval.insurance', $params);
    } 

    public function showApprovalList(Request $request)
    {
        $query = User::where('state',1)->with('rank');
        $ranks = Rank::get();

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
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

        $params = [
            'users' => $query,
            'ranks' => $ranks,
        ];

        return view('cs.approval.approval', $params);
    }  

    public function approveClaim(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'state' => 'required|integer',
            'remark' => 'nullable',
            'final_verify_amount' => 'required|integer',
        ]);

        $result = $this->eWalletRepo->approve($request->input(), "Guarantee");
        
        return redirect()->back()->withSuccess('Approve created.');
    }

    public function approveBonusWithdraw(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'state' => 'required|integer',
            'remark' => 'required'
        ]);

        $result = $this->eWalletRepo->approve($request->input(), "Bonus");
        
        return redirect()->back()->withSuccess('Approve created.');
    }

    public function approveUser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'state' => 'required|integer',
            'apps_username' => 'required'
        ]);

        $result = $this->eWalletRepo->approve($request->input(), "User");
        
        return redirect()->back()->withSuccess('Approve created.');
    }

    public function rejectUser(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'state' => 'required|integer',
            'password' => 'password:cs'
        ],['password' => 'Wrong password']);

        $result = $this->eWalletRepo->approve($request->input(), "User");
        
        return redirect()->back()->withSuccess('Approve created.');
    }

    public function approveInsurancePoint(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'state' => 'required|integer',
            'remark' => 'required'
        ]);

        $result = $this->eWalletRepo->approve($request->input(), "InsurancePoint");

        return redirect()->back()->withSuccess('Approve created.');
    }

    public function updateMemberRank(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'rank_id' => 'required|integer'
        ]);


        $result = $this->userRepo->change($request->input(), "Rank");
        
        return redirect()->back()->withSuccess('Updated.');
    }

}