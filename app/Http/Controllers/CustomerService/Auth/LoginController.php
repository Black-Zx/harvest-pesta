<?php

namespace App\Http\Controllers\CustomerService\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/cs/approval/membership';

    public function __construct()
    {
        $this->middleware('guest:cs')->except('logout');
    }

    public function showLoginForm()
    {
        return view('cs.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function loggedOut()
    {
        return redirect()->route('cs.showLoginForm');
    }

    protected function guard()
    {
        return Auth::guard('cs');
    }
}
