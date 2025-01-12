<?php

namespace App\Http\Controllers\CustomerService;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CustomerService\BaseController;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageUser;
use App\Models\Bank;
use App\Models\Bonus;
use App\Exports\UserExportCasino;
use App\Exports\UserExportDirectBonus;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Storage;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends BaseController {

    public function showMemberList(Request $request)
    {
        $query = User::where('state',1);

        if($request->filled('from') && $request->filled('to')) {
            $query = $query->whereBetween('created_at', [$request->from. " 00:00:00", $request->to. " 23:59:59"]);
        }

        if($request->filled('protection_status')) {
            $query = $query->where('protection_state', $request->protection_status);
        }
        
        if($request->filled('username')) {
            $query = $query->where('username', 'like', '%'.$request->username.'%');
        }

        if($request->filled('name')) {
            $query = $query->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->filled('email')) {
            $query = $query->where('email', 'like', '%'.$request->email.'%');
        }

        if($request->filled('contact_number')) {
            $query = $query->where('contact_number', 'like', '%'.$request->contact_number.'%');
        }

        $query = $query->orderBy('id','desc')->paginate(20);
        
        $params = [
            'users' => $query
        ];

        return view('cs.member', $params);
    }

    public function showMemberDetail($id = null)
    {

        $packages = Package::all();
        $banks = Bank::all();
        $params = [];

        if($id) {
            $user = User::findOrFail($id);
            $params = [
                'user' => $user,
                'packages' => $packages,
                'banks' => $banks,
                'package_users' => $user->packages
            ];
    
            return view('cs.member.edit', $params);
        }
        else {

            $params = [
                'packages' => $packages,
                'banks' => $banks
            ];

            return view('cs.member.create', $params);
        }
    }

    public function postRegistration(Request $request)
    {  
        $request->validate([
            'referral_id' => 'required|integer',
            'username' => 'required|unique:users',
            'name' => 'required',
            'line_account' => 'required',
            'contact_number' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(User::rejected, 'state')
            ],
            'gender' => 'integer',
            'dob' => 'required|date_format:"Y-m-d"',
            'password' => 'required|confirmed|min:6',
            // 'bank_id' => 'required|integer',
            'bank_account' => 'required',
            // 'bank_account_name' => 'required'
        ]);

        if($request->referral_id == 0) {
            return redirect()->back()->withErrors(['Please check your upline username.']);
        }
        
        $check = new User;
        $check->username = $request->username;
        $check->name = $request->name;
        $check->contact_number = $request->contact_number;
        $check->email = $request->email;
        $check->dob = $request->dob;
        $check->parent_id = $request->referral_id;
        $check->gender = $request->gender;
        $check->contact_number = $request->contact_number;
        $check->bank_id = $request->bank_id;
        $check->bank_account = $request->bank_account;
        $check->bank_account_name = $request->bank_account_name;
        $check->password = bcrypt($request->password);
        $check->package_id = $request->package_id;
        $check->save();

        //Bind new packages
        foreach ($request->packages as $key => $value) {
            $package_user = new PackageUser;
            $package_user->package_id = $value['package_id'];
            $package_user->user_id = $check->id;
            $package_user->policy_number = $value['package_id'].''.$check->id.''.PackageUser::all()->count();
            $package_user->save();
       }
        //bind tree node
        User::fixTree();
         
        return redirect()->back()->withSuccess('Great! You have Successfully loggedin');
    }


    public function editMember(Request $request, $id)
    {  
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'line_account' => 'required',
            'apps_username' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email',
            'gender' => 'integer',
            'dob' => 'required|date_format:"Y-m-d"',
            // 'bank_id' => 'required|integer',
            'bank_account' => 'required',
            // 'bank_account_name' => 'required'
        ]);
           
        $check = User::findOrFail($id);
        $check->username = $request->username;
        $check->name = $request->name;
        $check->contact_number = $request->contact_number;
        $check->email = $request->email;
        $check->dob = $request->dob;
        $check->gender = $request->gender;
        $check->contact_number = $request->contact_number;
        $check->bank_id = $request->bank_id;
        $check->bank_account = $request->bank_account;
        $check->bank_account_name = $request->bank_account_name;
        $check->save();

        $existing_packages = collect($check->packages)->pluck('policy_number');
        $current_packages = collect($request->packages)->pluck('policy_number');
        $diff = $existing_packages->diff($current_packages);

        //Check this user existing packages if deleted then soft delete
        foreach ($diff as $key => $value) {
            $package_user = PackageUser::where('policy_number', $value)->first();
            $package_user->deleted_at = Carbon::now();
            $package_user->deleted_by = Auth::user()->id;
            $package_user->save();
        }
        
        //Update or bind new packages
        foreach ($request->packages as $key => $value) {
            $package_user = PackageUser::where('policy_number', $value['policy_number'])->first();
            if($package_user){
                $package_user->package_id = $value['package_id'];
                $package_user->user_id = $check->id;
                $package_user->updated_by = Auth::user()->id;
            }else{
                $package_user = new PackageUser;
                $package_user->package_id = $value['package_id'];
                $package_user->user_id = $check->id;
                $package_user->policy_number = $value['package_id'].''.$check->id.''.PackageUser::all()->count();
            }
            $package_user->save();
        }
         
        return redirect()->back()->withSuccess('Great! You have Successfully loggedin');
    }

    public function createBonus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'deposit' => 'required|numeric',
            'type' => ['required',Rule::in([Bonus::commission, Bonus::other])]
        ]);

        $result = $this->eWalletRepo->create($request->input(), "Bonus created.");
        
        return redirect()->back()->withSuccess('Great! You have Successfully loggedin');
    }

    public function updateBlockStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'block' => 'required|integer'
        ]);

        $result = $this->userRepo->change($request->input());
        
        return redirect()->back()->withSuccess('This user status changed.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
        
        $result = $this->userRepo->change($request->input());

        return redirect()->back()->withSuccess('Success.');
    }

    public function addInsurancePoint(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'deposit' => 'required',
        ]);
        
        $result = $this->eWalletRepo->addByAdmin($request->input());

        return redirect()->back()->withSuccess('Success.');
    }

    public function importReport(Request $request)
    {

        $request->validate([
            // 'imported_at' => 'required|date_format:"Y-m-d"',
            'import_file' => 'required|file|mimes:csv'
        ]);

        $file = $request->file('import_file');
        $originalPath = 'imports/';
        $photoFileName = $originalPath.time().'_import_.'.$file->getClientOriginalExtension();
        
        $file_name = $file->getClientOriginalName();
        $file_size = $file->getSize();
        Storage::disk('public')->put($photoFileName, file_get_contents($file));
        
        $path = storage_path('app/public').'/'.$photoFileName;
        
        $result = $this->importRecordRepo->store($request->input(), $file_name, $file_size, $path, "casino");

        if ($result == "Success") {
            $this->importRecordRepo->bind($request->input(), $file_name, $file_size, $path);
        }
        
        return redirect()->back()->with('message', $result);
    }

    public function importDirectBonusesReport(Request $request)
    {

        $request->validate([
            'import_file' => 'required|file|mimes:csv'
        ]);

        $file = $request->file('import_file');
        $originalPath = 'imports/';
        $photoFileName = $originalPath.time().'_import_direct_bonus_.'.$file->getClientOriginalExtension();
        
        $file_name = $file->getClientOriginalName();
        $file_size = $file->getSize();
        Storage::disk('public')->put($photoFileName, file_get_contents($file));
        
        $path = storage_path('app/public').'/'.$photoFileName;
        
        $result = $this->importRecordRepo->store($request->input(), $file_name, $file_size, $path, "direct bonus");

        if ($result == "Success") {
            $this->importRecordRepo->bindDirectBonus($request->month, $request->year);
        }
        
        return redirect()->back()->with('message', $result);
    }

    public function exportUsers(Request $request)
    {
        if ($request->type == 'casino') {
            return Excel::download(new UserExportCasino(User::all()), "casino.csv");
        }else{
            return Excel::download(new UserExportDirectBonus(User::all()), "direct_bonus.csv");
        }
    }
}