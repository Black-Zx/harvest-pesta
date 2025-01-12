<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/p/team';

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function showLoginForm()
    {
        return view('member.auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('member.auth.forgotPassword');
    }

    public function postPasswordRequest(Request $request) {
        
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->withSuccess('success')
                    : back()->withErrors('Can’t find an account that matches');
    }

    public function showResetPasswordForm($token) {

        return view('member.auth.resetPassword', ['token' => $token]);
    }

    public function postResetPassword(Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('member.showLoginForm')->withSuccess('success')
                    : back()->withErrors('Can’t find an account that matches');

        return view('member.auth.resetPassword', ['token' => $token]);
    }

    public function username()
    {
        return 'username';
    }

    protected function loggedOut()
    {
        return redirect()->route('member.showLoginForm');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->block) {
            Auth::logout();
            return redirect('/login')->withErrors('Unable to login. Please contact your Administrator');
        }
    }
}
