<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Auth;

class BaseController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(['auth:web']);

        $this->middleware(function ($request, $next) {

            $this->user = auth()->user();

            // decide user role
            if(Auth::user()->rank->name != 'Business Partner') {
                return redirect('/');
            }

            return $next($request);
        });
    }
}
