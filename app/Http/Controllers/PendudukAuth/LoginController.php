<?php

namespace App\Http\Controllers\PendudukAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use App\Penduduk;
use Illuminate\Http\Request;

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
    public $redirectTo = '/penduduk/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('penduduk.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('penduduk.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('penduduk');
    }

    public function login(Request $request){
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required',
        'remember' => '',
      ]);
      
      $penduduk = Penduduk::where('email',$request->email)->first();
      if(is_null($penduduk)){
        $request->session()->flash('login_fail_email', 'Email Salah.');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif(Auth::guard('penduduk')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 2], $request->remember)){
        return redirect(url('/penduduk/home'));
      }
      elseif ($penduduk->status == 1) {
        $request->session()->flash('login_fail', 'Akun belum aktif, silakan aktivasi akun dulu!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif ($penduduk->status == 3) {
        $request->session()->flash('login_fail', 'Akun dibanned, silakan hubungi admin!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif ($penduduk->status == 4) {
        $request->session()->flash('login_fail', 'Akun dinonaktifkan , silakan hubungi admin untuk aktivasi ulang!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif ($penduduk->status == 5) {
        $request->session()->flash('login_fail', 'Akun belum aktif , silakan hubungi dinas terkait untuk aktivasi!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif($penduduk->status == 6){
        return redirect(url('/administrator/login'));
      }
      elseif ($penduduk->status == 7) {
        $request->session()->flash('login_fail', 'Akun dibanned , silakan hubungi dinas terkait untuk penjelasan lebih lanjut!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      elseif ($penduduk->status == 8) {
        $request->session()->flash('login_fail', 'Akun dinonaktifkan , silakan hubungi dinas terkait untuk aktivasi!');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
      else{
        $request->session()->flash('login_fail_password', 'Wrong password.');
        $request->session()->flash('email', $request->email);
        return redirect(url('/penduduk/login'));
      }
    }
}
