<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\EWalletRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\InsurancePoint;
use App\Models\User;
use App\Models\Guarantee;
use App\Models\Rank;
use App\Models\Bonus;
use App\Models\Leaderboard;
use App\Jobs\earnBonus;
use App\Jobs\leaderboardRecords;
use Carbon\Carbon;

Use Image;

class EWalletController extends BaseController
{

    public function __construct(EWalletRepositoryInterface $eWalletRepo)
    {
        $this->eWalletRepo = $eWalletRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approveList(Request $request, $limit = 15)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required',Rule::in([InsurancePoint::purchaseInsurancePoint, InsurancePoint::withdrawBonus, InsurancePoint::registerMember, InsurancePoint::guaranteeClaim])]
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $query = "";

        switch ($request['type']) {
            case InsurancePoint::purchaseInsurancePoint:
                $query = InsurancePoint::where("transaction_type", InsurancePoint::purchase)->where("state", InsurancePoint::pending)->with('payor_user', 'payee_user', 'user');
                break;
            case InsurancePoint::withdrawBonus:
                $query = Bonus::where("transaction_type", Bonus::withdraw)->where("state", InsurancePoint::pending)->with('payor_user', 'payee_user', 'user');
                break;
            case InsurancePoint::registerMember:
                $query = User::where("state", InsurancePoint::pending);
                break;
            case InsurancePoint::guaranteeClaim:
                $query = Guarantee::where("state", InsurancePoint::pending)->with('user');
                break;
            default:
                # code...
                break;
        }
        return $this->sendResponse($query->paginate($limit), 'Get list.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transferInsurancePoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payee_user_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (!Hash::check($request->password, Auth::user()->password)) {
            return $this->sendError('Error.', 'Wrong password');
        }

        if ((Auth::user()->totalInsurancePoint() - $request['amount']) < 0) {
            return $this->sendError('Error.', 'Insufficient amount');
        }
        
        return $this->sendResponse($this->eWalletRepo->transfer($request->input()), 'Transfer created.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseInsurancePoint(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'deposit' => 'required|integer',
            'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|nullable',
            'image3' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $tmp_file_name = [];        
        for ($i=1; $i <= 3; $i++) {
            $tmp = "image" . $i;
            if ($request->$tmp != null) {
                $file = $request->file($tmp);
                $ogImage = Image::make($file);
                $originalPath = public_path().'/images/';
                $photoFileName = $originalPath.time().$file->getClientOriginalName();
                $ogImage =  $ogImage->save($photoFileName);
                $tmp_file_name[] = $photoFileName;
            }
        }
        $request['photo_array'] = $tmp_file_name;
        
        return $this->sendResponse($this->eWalletRepo->purchase($request->input()), 'Purchase created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function claimGuarantee(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer',
            'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|nullable',
            'image3' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|nullable',
            'remark' => 'nullable'
        ]);

        $tmp_file_name = [];        
        for ($i=1; $i <= 3; $i++) {
            $tmp = "image" . $i;
            if ($request->$tmp != null) {
                $file = $request->file($tmp);
                $ogImage = Image::make($file);
                $originalPath = public_path().'/images/';
                $photoFileName = $originalPath.time().$file->getClientOriginalName();
                $ogImage =  $ogImage->save($photoFileName);
                $tmp_file_name[] = $photoFileName;
            }
        }
        $request['photo_array'] = $tmp_file_name;

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->claim($request->input()), 'Claim created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withdrawBonus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->withdraw($request->input()), 'Withdraw created.');

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function convertInsurancePoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required',Rule::in([InsurancePoint::insurancePointToBonus, InsurancePoint::bonusToInsurancePoint])],
            'amount' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        switch ($request['type']) {
            case InsurancePoint::insurancePointToBonus:
                if ((Auth::user()->totalInsurancePoint() - $request['amount']) < 0) {
                    return $this->sendError('Error.', 'Insufficient insurance Point');
                }
                break;
            case InsurancePoint::bonusToInsurancePoint:
                if ((Auth::user()->totalBonus() - $request['amount']) < 0) {
                    return $this->sendError('Error.', 'Insufficient bonus');
                }
                break;
            default:
                # code...
                break;
        }

        return $this->sendResponse($this->eWalletRepo->convert($request->input()), 'Convert created.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveInsurancePoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'state' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->approve($request->input(),"InsurancePoint"), 'Approve created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveClaim(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'state' => 'required|integer',
            'remark' => 'nullable',
            'final_verify_amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->approve($request->input(),"Guarantee"), 'Approve created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'state' => 'required|integer',
            'app_user' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->approve($request->input(),"User"), 'Approve created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBonus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'deposit' => 'required|integer',
            'type' => ['required',Rule::in([Bonus::commission, Bonus::other])]
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->create($request->input()), 'Bonus created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveBonusWithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'state' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        return $this->sendResponse($this->eWalletRepo->approve($request->input(),"Bonus"), 'Approve created.');

    }

    public function calculateBonus()
    {
        $users = User::with('packageInsurancePoint')->where('state', 1)->get();

        foreach ($users as $user) {

            foreach ($user->packages as $key => $package) {
                $insurance_point = $package->package->insurance_point;

                if ($user->totalInsurancePoint()-$insurance_point < 0) {
                    $user->protection_state = 0;
                    $user->save();
                    $this->eWalletRepo->pay(array(
                        "user_id" => $user->id,
                        "pay" => 0,
                        "able_pay" => 0,
                        "policy_number" => $package->policy_number,
                        "user_total_insurance_point" => $user->totalInsurancePoint()
                ));
                    continue;
                }
                $user->protection_state = 1;
                $user->save();
                $tt = $this->eWalletRepo->pay(array(
                    "user_id" => $user->id,
                    // "pay" => 0,
                    "pay" => $insurance_point,
                    "able_pay" => 1,
                    "policy_number" => $package->policy_number,
                    "user_total_insurance_point" => $user->totalInsurancePoint()

                ));
                // return $tt;
                $this->processBonus($user, $insurance_point, $package->policy_number);
                // $this->processBonus($user, $insurance_point);
            }
            dispatch(new leaderboardRecords(["user_id"=>$user->id, "point"=>$user->bonuses()->BonusCommissionMonthly()]));
        }
        return "s";
        
        // return $this->sendResponse($this->eWalletRepo->approve($request->input(),"Bonus"), 'Approve created.');

    }

    public function updateLeaderboard(){
        $users = User::with('packageInsurancePoint')->where('state', 1)->get();

        foreach ($users as $user) {
            dispatch(new leaderboardRecords(["user_id"=>$user->id, "point"=>$user->bonuses()->BonusCommissionMonthly()]));
        }
        return "done";
    }

    public function calculateBonusTest()
    {
        $users = User::where('id',28)->with('packageInsurancePoint')->where('state', 1)->get();

        foreach ($users as $user) {
            return $user->getRanking($user->id);
            dispatch(new leaderboardRecords(["user_id"=>$user->id, "point"=>$user->bonuses()->BonusCommissionMonthly()]));
        }
        return "done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function processBonus($user, $insurance_point, $policy_number)
    {
        //previous 60% profit of deposit insurance_point
        $insurance_point_profit = (60 / 100) * $insurance_point;
        //100% profit of deposit insurance_point
        // $insurance_point_profit = $insurance_point;
        $insurance_point_remaining = 0;
        $check_upper_line = $user->upper_line_user;
        $current_user = $user;
        $count = 0;
        $deposit = 0;
        $storeRankArray = array();

        while ($check_upper_line != NULL) {
            $storeRankArray[] = $check_upper_line->rank->id;
            switch ($check_upper_line->rank->id) {
                case Rank::Member:
                    $count++;
                    break;
                case Rank::Agent:
                    $last_rank = end($storeRankArray);
                    if ($user->rank->id <= $check_upper_line->rank->id) {
                        $compare_ex_rank_id_bigger = 0;
                        $compare_ex_rank_id_equal = 0;
                        $deposit = 0;

                        for ($i=0; $i < count($storeRankArray)-1; $i++) {
                            if ($storeRankArray[$i] > $last_rank) {
                                $compare_ex_rank_id_bigger++;
                            }
                        }

                        if ($compare_ex_rank_id_bigger > 0) {
                            $deposit = 0 * $insurance_point_profit;
                        }else{
                            if ($count == 0) {
                                // $deposit = (60 / 100) * $insurance_point_profit;
                                $deposit = ($check_upper_line->rank->percentage / 100) * $insurance_point_profit;
                                dispatch(new earnBonus(["user_id"=>$user->id, "deposit"=>$deposit, "payee_user_id" => $check_upper_line->id, "policy_number"=>$policy_number]));
                                $count++;
                            }elseif ($count == 1) {
                                $deposit = (10 / 100) * $insurance_point_profit;
                                dispatch(new earnBonus(["user_id"=>$user->id, "deposit"=>$deposit, "payee_user_id" => $check_upper_line->id, "policy_number"=>$policy_number]));
                                $count++;
        
                            }elseif ($count == 2) {
                                $deposit = (10 / 100) * $insurance_point_profit;
                                dispatch(new earnBonus(["user_id"=>$user->id, "deposit"=>$deposit, "payee_user_id" => $check_upper_line->id, "policy_number"=>$policy_number]));
                                $count++;
                            }
                        }

                    }
                    break;
                case Rank::Master_Agent:
                case Rank::Shareholder:
                case Rank::Master_Shareholder:
                    $last_rank = end($storeRankArray);
                    $deposit = 0;
                    //if direct 
                    if (count($storeRankArray) == 1) {
                        if($user->rank->id == $last_rank){
                            $deposit = (5 / 100) * $insurance_point_profit;
                        }else if($user->rank->id > $last_rank){
                            $deposit = 0 * $insurance_point_profit;
                        }else{
                            $deposit = ($check_upper_line->rank->percentage / 100) * $insurance_point_profit;
                        }
                    }else if (count($storeRankArray) == 2) {
                        if($user->rank->id >= $last_rank){
                            $deposit = 0 * $insurance_point_profit;
                        }else{
                            $last_2_rank = prev($storeRankArray);
                            //if direct
                            if($last_2_rank == $last_rank){
                                $deposit = (5 / 100) * $insurance_point_profit;
                            }else if($last_2_rank > $last_rank){
                                $deposit = 0 * $insurance_point_profit;
                            }else{
                                $deposit = ($check_upper_line->rank->percentage / 100) * $insurance_point_profit;
                            }
                        }
                    }else if(count($storeRankArray) == 3){

                        if($user->rank->id >= $last_rank){
                            $deposit = 0 * $insurance_point_profit;
                        }else{
                            $last_2_rank = prev($storeRankArray);
                            $last_3_rank = prev($storeRankArray);
                            if($last_3_rank >= $last_rank){
                                $deposit = 0 * $insurance_point_profit;
                            }else if($last_3_rank < $last_rank){
                                if ($last_2_rank == $last_rank) {
                                    $deposit = (5 / 100) * $insurance_point_profit;
                                }else if($last_2_rank > $last_rank){
                                    $deposit = 0 * $insurance_point_profit;
                                }else{
                                    $deposit = ($check_upper_line->rank->percentage / 100) * $insurance_point_profit;
                                }
                            }
                        }

                    }else if(count($storeRankArray) > 3){

                        if($user->rank->id >= $last_rank){
                            $deposit = 0 * $insurance_point_profit;
                        }else{
                            $compare_ex_rank_id_bigger = 0;
                            $compare_ex_rank_id_equal = 0;

                            for ($i=0; $i < count($storeRankArray)-1; $i++) { 
                                if ($storeRankArray[$i] > $last_rank) {
                                    $compare_ex_rank_id_bigger++;
                                }

                                if ($storeRankArray[$i] == $last_rank) {
                                    $compare_ex_rank_id_equal++;
                                }
                            }

                            if ($compare_ex_rank_id_equal > 0 || $compare_ex_rank_id_bigger >0) {
                                $deposit = 0 * $insurance_point_profit;
                            }else if($compare_ex_rank_id_equal == 1){
                                $deposit = (5 / 100) * $insurance_point_profit;
                            }else{
                                $deposit = ($check_upper_line->rank->percentage / 100) * $insurance_point_profit;
                            }
                        }
                    }

                    dispatch(new earnBonus(["user_id"=>$user->id, "deposit"=>$deposit, "payee_user_id" => $check_upper_line->id, "policy_number"=>$policy_number]));
                    break;
                default:
                    # code...
                    break;
            }

            $check_upper_line = $check_upper_line->upper_line_user;
            
            if ($check_upper_line == NULL) {
                break;
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserTree()
    {
        $user_id = 2;
        User::fixTree();
        return User::with("rank","package")->defaultOrder()->descendantsAndSelf($user_id)->toTree();
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportList(Request $request, $limit = 15)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required',Rule::in([InsurancePoint::purchaseReport, InsurancePoint::transferReport, InsurancePoint::withdrawReport, InsurancePoint::bonusReport, InsurancePoint::guaranteeReport])],
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $query = "";

        switch ($request['type']) {
            case InsurancePoint::purchaseReport:
                $query = InsurancePoint::where("transaction_type", InsurancePoint::purchase)->where("state", InsurancePoint::approved)->whereBetween('created_at', [$request['from'], $request['to']])->where("user_id", Auth::user()->id)->with('payor_user', 'payee_user', 'user');
                break;
            case InsurancePoint::transferReport:
                $query = InsurancePoint::where("transaction_type", InsurancePoint::transfer)->where("state", InsurancePoint::approved)->whereBetween('created_at', [$request['from'], $request['to']])->where("user_id", Auth::user()->id)->with('payor_user', 'payee_user', 'user');
                break;
            case InsurancePoint::withdrawReport:
                $query = Bonus::where("transaction_type", Bonus::withdraw)->whereBetween('created_at', [$request['from'], $request['to']])->where("user_id", Auth::user()->id)->with('payor_user', 'payee_user', 'user', 'bank');
                break;
            case InsurancePoint::bonusReport:
                $query = Bonus::where("state", Bonus::approved)->whereBetween('created_at', [$request['from'], $request['to']])->where("user_id", Auth::user()->id)->with('user', 'bank');
                break;
            case InsurancePoint::guaranteeReport:
                $query = Guarantee::where("state", Guarantee::approved)->whereBetween('created_at', [$request['from'], $request['to']])->where("user_id", Auth::user()->id)->with('user');
                break;
            default:
                # code...
                break;
        }
        return $this->sendResponse($query->paginate($limit), 'Get list.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
