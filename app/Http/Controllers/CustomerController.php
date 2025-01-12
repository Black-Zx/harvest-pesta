<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Customer;
use App\Models\Beer;
use App\Models\DateTimeSlot;
use App\Models\CustomerDateSlot;
use Illuminate\Support\Facades\DB;
use QrCode;
use App\Mail\SendQrMail;
use Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $params = [
            "show" => false
        ];
        // return Customer::find(17)->date_time_slot_latest_record->last()->event;
        return view('interested',$params);

    }

    public function tnc(){
        // return Customer::find(17)->date_time_slot_latest_record->last()->event;
        return view('tnc');

    }

    public function landing($fd=null){
        // return $fd;
        $params=[
            'fd'=> $fd,
        ];
        return view('landing', $params);
    }

    public function detail($fd=null){
        $params=[
            'fd'=>$fd,
        ];
        return view('detail', $params);
    }

    public function email(){
        $params = [
            "customer" => Customer::find(17)
        ];
        return view('emails.qr', $params);
    }

    public function interested(Request $request, $fd=null){
        // $validated = $request->validate([
        //     'first' => 'required|integer',
        //     'second' => 'required|integer',
        //     'third' => 'required|integer',
        //     'fourth' => 'required|integer'
        // ]);
        // return $fd;
        if ($fd) {
            redirect('/');
        }

        $first = (int)$request->first*1000 ;
        $second = (int)$request->second*100 ;
        $third = (int)$request->third*10 ;
        $fourth = (int)$request->fourth;

        if ((2024 - ((int)$first + (int)$second + (int)$third + (int)$fourth)) < 21) {
            return redirect()->back()->withErrors('Opps, please try again.');
        }

        if ( $request->check ) {
            return redirect()->route('rsvp.landing', ['fd'=>$fd]);
            // return view('landing');
        }

        // if ($fd) {
        //     return view('landing');
        // }
        $params = [
            "show" => false,
            "fd" => $fd,
        ];
        return view('home',$params);

        // return redirect('/rsvp/register');
    }

    public function register(Request $request, $fd=null){

        $beers = Beer::get();

        if (url()->current() == "https://carlsberggolffestival2022.com/rsvp") {
            return view('404');
        }

        if (!$request->filled("e")) {
            $request->e = "";
        }
        
        $events = Event::with('dateSlots')->get();
        foreach ($events as $key => $value) {
            foreach ($value->dateSlots as $key => $value2) {
                $value2->title = $value2->date->format('d F Y, h:i A');
            }
        }
        $params = [
            "events" => $events,
            "event_id" => $request->e,
            "beers" => $beers,
            'fd' => $fd,
        ];
        return view('rsvp', $params);
    }

    public function rsvp(Request $request){
// return $request;
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'nric' => 'required',
            'beer' => 'required',
            'date' => 'required',
        ]);

        if ( !$validated ) {
            return redirect()->back()->withErrors('Opps, please try again.');
        }

        $check =  mb_substr($request->nric, 0, 2);

        if (is_numeric((int)$check)) {
            if(( 04 <= $check) && ($check <= 24)){
                return redirect()->back()->withErrors('Opps, you are under the age of 21.');
            }
        }

        // $time_slot  = DateTimeSlot::find($request->time_slot_id)->first();
        // if ($time_slot->slot_used >= $time_slot->slot) {
        //     return redirect()->back()->with('slots', 'Opps, it no available for this moment.');
        // }

        $check_customer  = Customer::where('nric', $request->nric)->where('date', $request->date)->first();
        if( $check_customer ){
            return redirect()->back()->withErrors('Apologies, it seems you have already registered for the same date.');
        }

        if ($request->fixed_date != null) {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->nric = $request->nric;
            $customer->beer = $request->beer;
            $customer->date = $request->date;
            $customer->fixed_date = $request->fixed_date;
            $customer->save();
        } else {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->mobile = $request->mobile;
            $customer->nric = $request->nric;
            $customer->beer = $request->beer;
            $customer->date = $request->date;
            $customer->save();
        }
        
        

        if($customer->qr_code == NULL){
            $hash1 = $customer->id."_1_".Str::random(5);
            $hash2 = $customer->id."_2_".Str::random(5);
            $path1 = "qr/".$hash1.".jpg";
            $path2 = "qr/".$hash2.".jpg";
            QrCode::size(500)->format('png')->merge('https://harvestpesta.myecdc.com/qr/carlsberg-logo.jpg', .13, true)->margin(2)->generate($hash1, public_path($path1));
            QrCode::size(500)->format('png')->merge('https://harvestpesta.myecdc.com/qr/carlsberg-logo.jpg', .13, true)->margin(2)->generate($hash2, public_path($path2));
            $customer->qr_code = config('app.url')."".$path1;
            $customer->unique_code = $hash1;
            $customer->qr_code_guest = config('app.url')."".$path2;
            $customer->unique_code_guest = $hash2; 
            $customer->save();
        }
        // $email = new SendQrMail($customer, $time_slot);
        // Mail::to([$customer->email])->queue($email);
        
        // $customer->date_time_slots()->syncWithPivotValues($request->time_slot_id, ['created_at' => Carbon::now()->format('Y-m-d H:i:s')], false);

        // $date_time_slots = DateTimeSlot::all();
        // foreach ($date_time_slots as $key => $value) {
        //     $value->slot_used = $value->customers->count();
        //     $value->save();
        // }

        $params = [
            "customer" => $customer,
            // "time_slot" => $time_slot,
            // "type" => $time_slot->event_id == 1 ? 1:2
        ];
        return view('thankyou', $params);
    }
}
