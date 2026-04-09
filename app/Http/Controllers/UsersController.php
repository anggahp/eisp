<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('guest')->except('logout');
    }
    
    public function login()
    {
        return view('auths.signin');
    }

    protected function validatorLogin(array $data)
    {
        return Validator::make($data, [
            'name' => 'exists:users,name',
            'password' => 'required',
        ]);
    }
    
    public function signInCek(Request $request)
    {
        // validate request data
        $this->validatorLogin($request->all())->validate();

        $attempts = [
            'name' => $request->name,
            'password' => $request->password,
            'status' => 'activated',
        ];

        if (Auth::attempt($attempts, (bool) $request->remember)) {
            return redirect()->intended('/home');
        }

        return redirect()->back()->withInput($request->only('name'))->withErrors([
            'password' => 'The password is invalid.',
        ]);
    }

    public function logout(Request $request)
    {
        // Session::flush();
        // return redirect('/');        
        if (Auth::check()) {
            $this->guard()->logout();
            $request->session()->invalidate();
        }
        
        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function form()
    {        
        return view('auths.signup');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:5', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function store(Request $request)
    {   
        // validate request data
        $this->validator($request->all())->validate();
        
        $results = DB::table('android.dbo.MSSUPPLIER')
                ->where('SUPPLIERCODE', '=', $request->name)
                ->first();

        $full_name = $request->name; 
        $user_type = '';
        $user_grp = '';
        $status = 'pending';
        if(!empty($results)) {
            $full_name = $results->SUPPLIERNAME; 
            $user_type = 'user';  
            $user_grp = 'supp';  
            $status = 'activated';     
        } else {
            $results = DB::table('android.dbo.MSCUST')
                    ->where('CUSTCODE', '=', $request->name)
                    ->first();

            if(!empty($results)) {
                $full_name = $results->CUSTNAME; 
                $user_type = 'user'; 
                $user_grp = 'cust'; 
                $status = 'activated';      
            } else {
                $full_name = $request->name; 
                $user_type = $request->user_type; 
                $user_grp = $request->user_grp; 
                $status = 'activated';
            }
        }
        
        // save into table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $full_name,
            'user_type' => $user_type,
            'user_grp' => $user_grp,
            'status' => $status
        ]);
        // autologin
        // Auth::loginUsingId($user->id);
        // redirect to home
        return redirect('/home');
    }
}
