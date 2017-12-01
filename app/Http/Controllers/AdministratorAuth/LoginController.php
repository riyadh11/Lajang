<?php

namespace App\Http\Controllers\AdministratorAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Administrator;
use App\Penduduk;
use Illuminate\Http\Request;
use Hesto\MultiAuth\Traits\LogsoutGuard;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/administrator/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('administrator.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('administrator.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('administrator');
    }

    public function login(Request $request){
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required',
        'remember' => '',
      ]);
      
      $administrator = Administrator::where('email',$request->email)->first();
      if(is_null($administrator)){
        $request->session()->flash('login_fail_email', 'Email Salah.');
        $request->session()->flash('email', $request->email);
        return redirect(url('/administrator/login'));
      }
      elseif(Auth::guard('administrator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
        if($administrator->Penduduk->status==6){
            return redirect(url('/administrator/home'));
        }else{
             return redirect(url('/administrator/logout'));
        }
      }
      else{
        $request->session()->flash('login_fail_password', 'Wrong password.');
        $request->session()->flash('email', $request->email);
        return redirect(url('/administrator/login'));
      }
    }
}
