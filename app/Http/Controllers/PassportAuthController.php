<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends BaseController
{
    public function __construct(PackageRepositoryInterface $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|integer',
            'referral_id' => 'required|integer',
            'username' => 'required',
            'name' => 'required',
            'contact_number' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(User::rejected, 'state')
            ],
            'gender' => 'integer',
            'dob' => 'required|date_format:"Y-m-d"',
            'password' => 'required|min:6',
            'bank_id' => 'required|integer',
            'bank_account' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
 
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'upper_line_id' => $request->referral_id,
            'contact_number' => $request->contact_number,
            'bank_id' => $request->bank_id,
            'bank_account' => $request->bank_account,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'package_id' => $request->package_id
        ]);

       
        $token = $user->createToken('user')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function userLogin(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
 
        if (Auth::guard('web')->attempt($data)) {
            $token = Auth::guard('web')->user()->createToken('user')->accessToken;
            return $this->sendResponse($token, 'Get Token.');
        } else {
            return $this->sendError('Unauthorised', 'Invalid Login Credentials.');
        }
    }   

    /**
     * Login
     */
    public function customerServiceLogin(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
 
        if (Auth::guard('cs')->attempt($data)) {
            $token = Auth::guard('cs')->user()->createToken('cs')->accessToken;
            return $this->sendResponse(["token"=>$token,"user"=>Auth::guard('cs')->user()], 'Get Token.');
        } else {
            return $this->sendError('Unauthorised', 'Invalid Login Credentials.');
        }
    }   

    /**
     * Login
     */
    public function adminLogin(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
 
        if (Auth::guard('admin')->attempt($data)) {
            $token = Auth::guard('admin')->user()->createToken('admin')->accessToken;
            return $this->sendResponse($token, 'Get Token.');
        } else {
            return $this->sendError('Unauthorised', 'Invalid Login Credentials.');
        }
    } 
}