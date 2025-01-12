<?php

namespace App\Http\Controllers\Helpers;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller {

    public function index($locale){
        
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}