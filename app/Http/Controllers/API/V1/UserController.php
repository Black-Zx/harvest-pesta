<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse($this->userRepo->change($request->input()), 'Success.');
    }

    public function changeBankAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_id' => 'required|integer',
            'bank_account' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse($this->userRepo->change($request->input()), 'Success.');
    }

    public function findUserByUsername(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse(User::where('username',$request->username)->get(), 'Success.');
    }

    public function membersReport()
    {
        $users = User::get();

        foreach ($users as $key => $user) {
            $user->totalInsurancePoint = $user->totalInsurancePoint();
            $user->totalBonus = $user->totalBonus();
            $user->package = $user->package;
            $user->rank = $user->rank;
            $user->upper_line_user = $user->upper_line_user;
            $user->other_bonus = $user->bonuses()->BonusOther();
            $user->direct_bonus = $user->bonuses()->BonusCommission();
            $user->downline = $user->descendants->count();
        }
        
        return $users;
    }

    public function insurancePointsReport()
    {
        $users = User::get();

        foreach ($users as $key => $user) {
            $user->deposit = $user->insurance_points()->Deposit();
            $user->withdraw = $user->insurance_points()->Withdraw();
            $user->total = $user->deposit - $user->withdraw;
        }
        
        return $users;
    }
}
