<?php

namespace App\Http\Controllers\CustomerService;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EWalletRepositoryInterface;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use App\Repositories\Interfaces\BankRepositoryInterface;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BonusPoolRepositoryInterface;
use App\Repositories\Interfaces\ImportRecordRepositoryInterface;

class BaseController extends Controller
{
    protected $user, $eWalletRepo, $bannerRepo, $packageRepo, $userRepo;

    public function __construct(EWalletRepositoryInterface $eWalletRepo, BannerRepositoryInterface $bannerRepo, PackageRepositoryInterface $packageRepo, UserRepositoryInterface $userRepo, BankRepositoryInterface $bankRepo, BonusPoolRepositoryInterface $bonusPoolRepo, ImportRecordRepositoryInterface $importRecordRepo)
    {
        $this->middleware(['auth:cs']);
        $this->eWalletRepo = $eWalletRepo;
        $this->bannerRepo = $bannerRepo;
        $this->packageRepo = $packageRepo;
        $this->userRepo = $userRepo;
        $this->bankRepo = $bankRepo;
        $this->bonusPoolRepo = $bonusPoolRepo;
        $this->importRecordRepo = $importRecordRepo;

        $this->middleware(function ($request, $next) {

            $this->user = auth()->user();
            return $next($request);
        });
    }
}
