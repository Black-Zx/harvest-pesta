<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BonusPoolRepositoryInterface;

class BaseController extends Controller
{
    protected $user, $userRepo, $bonusPoolRepo;

    public function __construct(UserRepositoryInterface $userRepo, BonusPoolRepositoryInterface $bonusPoolRepo)
    {
        $this->middleware(['auth:admin']);
        $this->userRepo = $userRepo;
        $this->bonusPoolRepo = $bonusPoolRepo;

        $this->middleware(function ($request, $next) {

            $this->user = auth()->user();
            return $next($request);
        });
    }
}
