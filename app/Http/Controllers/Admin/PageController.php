<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerDateSlot;
use App\Models\DateTimeSlot;
use App\Models\Customer;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerRedemptionList;
use App\Exports\CustomerCheckinList;
use App\Models\Engagement;

use QrCode;
use Illuminate\Support\Str;

class PageController extends BaseController {

    public function dashboard(Request $request)
    {
        $result = $this->checkinDetails($request);

        // $test = $this->redemptionDetails($request);
        
        
        // $hash1 = "test_1_".Str::random(5);
        // $path1 = "qr/".$hash1.".jpg";
        // $etst = QrCode::size(500)->format('png')->margin(2)->generate($hash1, public_path($path1));
        // return $etst;
        
        $params = [
            'report1' => $result['query1']->paginate(370),
            'report2' => $result['query1']->where('date', '22th May 2024')->paginate(370),
            'report3' => $result['query1']->where('date', '23th May 2024')->paginate(370),
            'report4' => $result['query1']->where('date', '24th May 2024')->paginate(370),
            'report5' => $result['query1']->where('date', '25th May 2024')->paginate(370),
            'report_date1' => $result['query1']->select('date')->where('date', '22th May 2024')->first(),
            'report_date2' => $result['query1']->select('date')->where('date', '23th May 2024')->first(),
            'report_date3' => $result['query1']->select('date')->where('date', '24th May 2024')->first(),
            'report_date4' => $result['query1']->select('date')->where('date', '25th May 2024')->first(),
            // 'redemption_time' => $redemption_time,
            // 'img' => $img->qr_code,
            // 'report1_total' => 0,
            // 'report1_total' => $result['query1']->select('check_in', 'name', 'email', 'mobile', 'nric')->where('check_in', '<>', null)->groupBy('nric','check_in', 'name', 'email', 'mobile')->count(),
            'report1_total' => $result['query1']->where('check_in', '<>', null)->count(),
            'report2_total' => $result['query1']->where('check_in', '<>', null)->where('date', '22th May 2024')->count(),
            'report3_total' => $result['query1']->where('check_in', '<>', null)->where('date', '23th May 2024')->count(),
            'report4_total' => $result['query1']->where('check_in', '<>', null)->where('date', '24th May 2024')->count(),
            'report5_total' => $result['query1']->where('check_in', '<>', null)->where('date', '25th May 2024')->count(),
            'date' => $result['date']
        ];

        return view('admin.dashboard', $params);
    }

    public function redemption(Request $request)
    {
        $result = $this->redemptionDetails($request);

        $params = [
            'report_total' => $result["report"]->count(),
            'report' => $result["report"]->paginate(100),
            'date' => $result["date"]
        ];

        return view('admin.redemption', $params);
    }

    public function engagement(Request $request)
    {
        $result = $this->engagementDetails($request);

        $params = [
            'report_total' => $result["report"]->count(),
            'report' => $result["report"]->where('game', 1)->paginate(100),
            'date' => $result["date"]
        ];

        return view('admin.engagement', $params);
    }

    public function engagement2(Request $request)
    {
        $result = $this->engagementDetails($request);

        $params = [
            'report_total' => $result["report"]->count(),
            'report' => $result["report"]->where('game', 2)->paginate(100),
            'date' => $result["date"]
        ];

        return view('admin.engagement2', $params);
    }
    
    public function manualcheckIn(Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer) {
            if ($customer->check_in == null) {
                if ($request->type == 1) {
                    $customer->check_in = Carbon::now();
                    $customer->save();
                }else{
                    $customer->check_in_guest = Carbon::now();
                    $customer->save();
                }
                return redirect()->back()->withSuccess('Check in success.');
            }else {
                return redirect()->back()->withErrors('You have already checked in.');
            }
        }else{
            return redirect()->back()->withErrors('Please try again.');
        }
    }

    public function redemptionCheckIn(Request $request)
    {   
        $redemption = Redemption::where('customer_id', $request->id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->first();

        if(!$redemption){
            $redemption = new Redemption();
            $redemption->customer_id = $request->id;
            $redemption->save();

            return redirect()->back()->withSuccess('Successful Redemption.');
        }else{
            return redirect()->back()->withErrors('Please try again.');
        }

        // $user = Customer::where('unique_code', $request->unique_code)->first();

        // if($user){
        //     if (!$user) {
        //         return $this->sendError('User Not Found.');
        //     }

        //     if ( $user->checkin != null ) {
        //         $user->check_in = Carbon::now()->format('Y-m-d H:i:s');
        //         $user->save();
        //         return $this->sendResponse($user, 'Check In Success.');
        //     }
        //     else {
        //         return $this->sendError('Already Check In.');
        //     }
        //     // $user->check_in = Carbon::now()->format('Y-m-d H:i:s');
        //     // $user->save();
        //     // return $this->sendResponse($user, 'Check In Success.');
        // }else{
        //     return $this->sendError('User Not Found.');
        // }
    }

    public function rsvp(){
        return view('admin.rsvp');
    }

    public function rsvpUser(Request $request){
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('customers')
            ]
        ]);

        $check = new Customer();
        $check->name = $request->name;
        $check->mobile = $request->contact_number;
        $check->email = $request->email;
        $check->nric = $request->nric;
        $check->qr_code = "-";
        $check->check_in = Carbon::now();
        $check->save();

        return redirect()->back()->withSuccess('Great! You have Successfully loggedin');
    }

    public function redemptionDetails($array){

        if($array->filled('date')) {
            $date = $array->date;
        }else{
            $date = "-";
        }

        $query = new Redemption;
        $ids_customer = new Customer;
        $redemption_time = new Redemption;
        
        if($array->filled('date')) {
            $query = $query->whereDate('created_at', $date);
        }

        if($array->filled('name')) {
            $ids_customer = $ids_customer->where("name", 'like', '%'.$array->name.'%');
        }

        if($array->filled('email')) {
            $ids_customer = $ids_customer->where('email', 'like', '%'.$array->email.'%');
        }

        if($array->filled('nric')) {
            $ids_customer = $ids_customer->where('nric', 'like', '%'.$array->nric.'%');
        }

        if($array->filled('mobile')) {
            $ids_customer = $ids_customer->where('mobile', 'like', '%'.$array->mobile.'%');
        }

        $query = $query->whereIn('customer_id', $ids_customer->pluck('id'))->orderBy('created_at','desc');

        return array("report"=>$query, "date"=>$date);
    }

    public function checkinDetails($array){

        if($array->filled('date')) {
            $date = $array->date;
        }else{
            $date = "-";
        }

        $ids_customer = new Customer;

        if($array->filled('name')) {
            $ids_customer = $ids_customer->where("name", 'like', '%'.$array->name.'%');
        }

        if($array->filled('email')) {
            $ids_customer = $ids_customer->where('email', 'like', '%'.$array->email.'%');
        }

        if($array->filled('nric')) {
            $ids_customer = $ids_customer->where('nric', 'like', '%'.$array->nric.'%');
        }

        if($array->filled('mobile')) {
            $ids_customer = $ids_customer->where('mobile', 'like', '%'.$array->mobile.'%');
        }

        $query1 = $ids_customer;
        $query2 = $ids_customer;
        $query3 = $ids_customer;
        $query4 = $ids_customer;

        return array("query1" => $query1, "query2" => $query2, "query3" => $query3, "query4" => $query4,"date"=>$date);
    }

    public function export(Request $request)
    {
        $title = "";
        if ($request->type == "Redemption") {
            $result = $this->redemptionDetails($request);
            $export = new CustomerRedemptionList($result['report']->get());
        }else{
            $result = $this->checkinDetails($request);
            switch ($request->event) {
                case '1':
                    $export = new CustomerCheckinList($result['query1']->get());
                    // $export = new CustomerCheckinList($result['query1']->where('check_in', '<>', null)->groupBy('nric')->distinct()->get());
                    $title = "List";
                    break;
                case '2':
                    $export = new CustomerCheckinList($result['query2']->get());
                    $title = "Liquid Pouring Art Workshop";
                    break;
                case '3':
                    $export = new CustomerCheckinList($result['query3']->get());
                    $title = "Mixology Class Workshop";
                    break;
                case '4':
                    $export = new CustomerCheckinList($result['query4']->get());
                    $title = "Tote Bag Customisation Workshop";
                    break;
                case '5':
                    // $export = new CustomerCheckinList($result['query1']->where('check_in', '<>', null)->groupBy('nric')->distinct()->inRandomOrder()->limit(100)->get());
                    $export = new CustomerCheckinList($result['query1']->where('date', $request->report_date)->get());
                    $title = "List";
                    // $title = "Redeem a complimentary 1664 BLANC or 1664 ROSÉ";
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        return Excel::download($export, $title.$request->type.".xlsx");
    }

    public function engagementDetails($array){

        if($array->filled('date')) {
            $date = $array->date;
        }else{
            $date = "-";
        }

        $query = new Engagement;
        $ids_customer = new Customer;
        $engagement_time = new Engagement;
        
        if($array->filled('date')) {
            $query = $query->whereDate('created_at', $date);
        }

        if($array->filled('name')) {
            $ids_customer = $ids_customer->where("name", 'like', '%'.$array->name.'%');
        }

        if($array->filled('email')) {
            $ids_customer = $ids_customer->where('email', 'like', '%'.$array->email.'%');
        }

        if($array->filled('nric')) {
            $ids_customer = $ids_customer->where('nric', 'like', '%'.$array->nric.'%');
        }

        if($array->filled('mobile')) {
            $ids_customer = $ids_customer->where('mobile', 'like', '%'.$array->mobile.'%');
        }

        $query = $query->whereIn('customer_id', $ids_customer->pluck('id'))->orderBy('created_at','desc');

        return array("report"=>$query, "date"=>$date);
    }

    public function qrcode($id)
    {
        $img = Customer::select('qr_code')->where('id', $id)->first();

        $params =[
            'img' => $img->qr_code
        ];
        // $returnHTML = view('admin.qr_code',['img'=> $img])->render();

        // return response()->json([ 'html'=> $returnHTML]);
        return view('admin.qr_code', $params);
    }
}