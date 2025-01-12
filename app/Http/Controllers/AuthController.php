<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use App\Http\Controllers\BaseController as BaseController;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use Illuminate\Validation\Rule;

class AuthController extends BaseController
{
    public function __construct(PackageRepositoryInterface $packageRepo)
    {
        $this->packageRepo = $packageRepo;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  

      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return $this->sendResponse(Auth::guard('admin')->user(), 'Login Success');
        }
        
        return $this->sendError('Error.', 'Invalid cretentials');

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function customerServiceLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::guard('cs')->attempt($credentials)) {
            return $this->sendResponse(Auth::guard('admin')->user(), 'Login Success');
        }
        
        return $this->sendError('Error.', 'Invalid cretentials');

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return $this->sendResponse(Auth::guard('admin')->user(), 'Login Success');
        }
        
        return $this->sendError('Error.', 'Invalid cretentials');

    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'package_id' => 'required|integer',
            'referral_id' => 'required|integer',
            'username' => 'required',
            'name' => 'required',
            'contact_number' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(User::rejected, 'state')
            ],
            'gender' => 'integer',
            'dob' => 'required|date_format:"Y-m-d"',
            'password' => 'required|min:6',
            'bank_id' => 'required|integer',
            'bank_account' => 'required',
        ]);
           
        $data = $request->all();
        $check = new User;
        $check->username = $request->username;
        $check->name = $request->name;
        $check->contact_number = $request->contact_number;
        $check->email = $request->email;
        $check->dob = $request->dob;
        $check->upper_line_id = $request->referral_id;
        $check->gender = $request->gender;
        $check->contact_number = $request->contact_number;
        $check->bank_id = $request->bank_id;
        $check->bank_account = $request->bank_account;
        $check->password = bcrypt($request->password);
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}