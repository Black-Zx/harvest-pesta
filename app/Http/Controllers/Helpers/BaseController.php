<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;

class BaseController extends Controller
{
    protected $user, $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->middleware(['auth:web,cs']);
        $this->userRepo = $userRepo;

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
