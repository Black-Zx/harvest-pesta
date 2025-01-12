<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EWalletRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PackageRepositoryInterface;

class BaseController extends Controller
{
    protected $user, $eWalletRepo, $userRepo;

    public function __construct(EWalletRepositoryInterface $eWalletRepo, UserRepositoryInterface $userRepo, PackageRepositoryInterface $packageRepo)
    {
        $this->middleware(['auth:web']);
        $this->eWalletRepo = $eWalletRepo;
        $this->userRepo = $userRepo;
        $this->packageRepo = $packageRepo;

        $this->middleware(function ($request, $next) {

            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $success = true)
    {
        $response = [
            'success' => $success,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 422)
    {
        $response = [
            'success' => false,
            'data' => $errorMessages,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
