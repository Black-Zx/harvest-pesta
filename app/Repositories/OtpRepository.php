<?php

namespace App\Repositories;

use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Models\Otp;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendOtp;
use Mail;

class OtpRepository implements OtpRepositoryInterface
{
    public function store(array $array){
        $otp_code = $this->generateBarcodeNumber();
        Mail::to($array['email'])->send(new SendOtp($otp_code));

        $result = new Otp;
        $result->user_id = $array['user_id'];
        $result->username = $array['username'];
        $result->email_status = 1;
        $result->type = $array['type'];
        $result->email_status = Mail::failures()?0:1;
        $result->otp_code = $otp_code;
        $result->expired_at = Carbon::now()->addMinutes(Otp::expireTime)->format('Y-m-d H:i:s');
        $result->save();
        return $result;
    }

    public function check(array $array){
        $result = Otp::find($array['id']);
        $result->entered_code = $array['code'];
        $result->used_status = $array['code']==$result->otp_code?1:0;
        $result->keyed_in_at = Carbon::now()->format('Y-m-d H:i:s');
        $result->save();
        return $result;
    }

    private function generateBarcodeNumber()
    {
        $code = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);

        // call the same function if the barcode exists already
        if (self::barcodeNumberExists($code)) {
            return self::generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $code;
    }

    private function barcodeNumberExists($code)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Otp::byOtpCode($code)->byIsUsedStatus(true)->notExpired()->exists();
    }
}