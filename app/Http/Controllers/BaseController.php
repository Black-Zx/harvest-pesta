<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;


class BaseController extends Controller
{
    /**
     * Model Constructor
     */
    protected $model;

    /**
     * Constructor for building models
     */
    public function __construct($model = null)
    {
        $this->model = $model;
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
