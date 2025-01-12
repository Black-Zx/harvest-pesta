<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Otp;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Validation\Rule;
use App\Repositories\Interfaces\OtpRepositoryInterface;

class OtpController extends BaseController
{
    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => ['required',Rule::in([Otp::csLogin, Otp::adminLogin, Otp::editUser])],
            'user_id' => 'required|integer',
            'username' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $otp = $this->otpRepo->store($request->input());
        
        if (!$otp->email_status) {
            return $this->sendError('Send Email Error.', 'Sent email fail');
        }

        return $this->sendResponse($otp, 'Otp created.');

    }

    public function checkOtp(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $otp = Otp::notExpired()->byIsUsedStatus(false)->find($request->id);
        
        if (!$otp){
            return $this->sendError('Otp Error.', 'This otp has been used / had expired, please re-send another one.');
        }

        $otp = $this->otpRepo->check($request->input());

        // otp is invalid
        if ($otp->otp_code != $otp->entered_code){
            return $this->sendError('Otp Error.', 'Invalid Code.');
        }
        
        return $this->sendResponse($otp, 'Otp checked.');
    }
}
