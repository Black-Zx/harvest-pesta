<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendQrMail;
use Mail;
use Illuminate\Support\Str;
use QrCode;
use App\Models\Customer;
use App\Models\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer_id; 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer_id)
    {
        $this->customer_id = $customer_id['customer_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer = Customer::find($this->customer_id);
        $log = new Log();
        $log->type="test";
        $log->msg="test";
        $log->save();
        // if($customer->qr_code == NULL){
        //     $hash1 = $customer->id."_1_".Str::random(5);
        //     $hash2 = $customer->id."_2_".Str::random(5);
        //     $path1 = "qr/".$hash1.".jpg";
        //     $path2 = "qr/".$hash2.".jpg";
        //     QrCode::size(500)->format('png')->margin(2)->generate($hash1, public_path($path1));
        //     QrCode::size(500)->format('png')->margin(2)->generate($hash2, public_path($path2));
        //     $customer->qr_code = "https://rue1664.com/".$path1;
        //     $customer->unique_code = $hash1;
        //     $customer->qr_code_guest = "https://rue1664.com/".$path2;
        //     $customer->unique_code_guest = $hash2;
        //     $customer->save();
        // }

        // $email = new SendQrMail($customer);
        // Mail::to([$customer->email])->send($email);
    }

    public function failed($e)
    {
        dd($e);
    }

}