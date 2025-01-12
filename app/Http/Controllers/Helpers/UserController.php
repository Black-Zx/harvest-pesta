<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helpers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
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
}
