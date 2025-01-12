<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Member\BaseController;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\DateTimeSlot;
use App\Models\CustomerDateSlot;
use App\Models\Redemption;
use QrCode;
use App\Mail\SendQrMail;
use App\Models\Engagement;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PageController extends BaseController {

    public function dashboard()
    {
        return view('member.dashboard');
    }  

    public function scan()
    {
        return view('member.scan');
    }

    public function scan2()
    {
        return view('member.scan2');
    }

    public function scan3()
    {
        return view('member.scan3');
    }

    public function scan4()
    {
        return view('member.scan4');
    }

    public function redemption_scan()
    {
        return view('member.redemption');
    }

    public function engagement_scan()
    {
        return view('member.engagement');
    }

    public function engagement_scan2()
    {
        return view('member.engagement2');
    }

    public function checkIn(Request $request)
    {
        $user = Customer::where('unique_code', $request->unique_code)->first();

        if($user){
            if (!$user) {
                return $this->sendError('User Not Found.');
            }

            $userDate = Carbon::parse($user->date)->format('d-m-Y');
            $tdy = Carbon::now()->format('d-m-Y');

            if ($userDate == $tdy) {
                if ( $user->check_in == null ) {
                    $user->check_in = Carbon::now()->format('Y-m-d H:i:s');
                    $user->save();
                    return $this->sendResponse($user, 'Check In Success.');
                }
                else {
                    return $this->sendError('Oops, you have already checked in');
                }
            }else {
                // return $this->sendError('The QR code scanned is for ', $userDate);
                return $this->sendError('Please scan the correct QR code for today’s date');
            }
        }else{
            return $this->sendError('User Not Found.');
        }
    }

    public function redemption(Request $request)
    {
        $user = Customer::where('unique_code', $request->unique_code)->first();
        // $user = Customer::find('unique_code', $request->unique_code)->first();

        $userDate = Carbon::parse($user->date)->format('d-m-Y');
        $tdy = Carbon::now()->format('d-m-Y');

        if ($userDate == $tdy) {
            $time_slot_ids = DateTimeSlot::whereDate('date', Carbon::now()->format('Y-m-d'))->pluck('id');

            $checkUser = CustomerDateSlot::where('customer_id',$user->id)->whereIn('date_time_slot_id', $time_slot_ids)->get();

            if (!$checkUser) {
                return $this->sendError('User Not Found.');
            }
            
            $redemption = Redemption::where('customer_id', $user->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();

            if(!$redemption){
                $redemption = new Redemption();
                $redemption->customer_id = $user->id;
                $redemption->save();

                return $this->sendResponse($user, 'Successful Redemption.');
            }else{
                return $this->sendError('Oops, you have already made a redemption');
            }
        }else {
            // return $this->sendError('The QR code scanned is for ', $userDate);
            return $this->sendError('Please scan the correct QR code for today’s date');
        }
    }

    public function engagement(Request $request)
    {
        $user = Customer::where('unique_code', $request->unique_code)->first();

        $userDate = Carbon::parse($user->date)->format('d-m-Y');
        $tdy = Carbon::now()->format('d-m-Y');

        if ($userDate == $tdy) {
            $time_slot_ids = DateTimeSlot::whereDate('date', Carbon::now()->format('Y-m-d'))->pluck('id');

            $checkUser = CustomerDateSlot::where('customer_id',$user->id)->whereIn('date_time_slot_id', $time_slot_ids)->get();
    
            if (!$checkUser) {
                return $this->sendError('User Not Found.');
            }
            
            $redemption = Engagement::where('customer_id', $user->id)->where('game', $request->game)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();
    
            if(!$redemption){
                $redemption = new Engagement();
                $redemption->customer_id = $user->id;
                $redemption->game = $request->game;
                $redemption->save();
    
                return $this->sendResponse($user, 'Successful.');
            }else{
                return $this->sendError('Oops, you have already made an engagement');
            }
        }else {
            // return $this->sendError('The QR code scanned is for ', $userDate);
            return $this->sendError('Please scan the correct QR code for today’s date');
        }        
    }

    public function generateQR(){
        $users = Customer::where('qr_code',NULL)->get();

        foreach ($users as $key => $user) {

            $hash1 = $user->id."_1_".Str::random(5);
            $hash2 = $user->id."_2_".Str::random(5);
            $path1 = "qr/".$hash1.".jpg";
            $path2 = "qr/".$hash2.".jpg";
            QrCode::size(500)->format('png')->margin(2)->generate($hash1, public_path($path1));
            QrCode::size(500)->format('png')->margin(2)->generate($hash2, public_path($path2));
            $user->qr_code = "https://carlsberggolffestival2022.com/".$path1;
            $user->unique_code = $hash1;
            $user->qr_code_guest = "https://carlsberggolffestival2022.com/".$path2;
            $user->unique_code_guest = $hash2;
            $user->save();

            $email = new SendQrMail($user);
            Mail::to([$user->email])->send($email);
        }
        return "s";
    }

    public function generateQR2(){
        $users= Customer::all();
        foreach ($users as $key => $user) {

            $hash1 = $user->id."_1_".Str::random(5);
            $hash2 = $user->id."_2_".Str::random(5);
            $path1 = "qr/".$hash1.".jpg";
            $path2 = "qr/".$hash2.".jpg";
            QrCode::size(500)->format('png')->margin(2)->generate($hash1, public_path($path1));
            QrCode::size(500)->format('png')->margin(2)->generate($hash2, public_path($path2));
            $user->qr_code = "https://carlsberggolffestival2022.com/".$path1;
            $user->unique_code = $hash1;
            $user->qr_code_guest = "https://carlsberggolffestival2022.com/".$path2;
            $user->unique_code_guest = $hash2;
            $user->save();

            $email = new SendQrMail($user);
            Mail::to([$user->email])->send($email);
        }
        return "s";
    }
}