<?php

namespace App\Http\Controllers\PendudukAuth;

use App\Penduduk;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\confirmationAccount;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/penduduk/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('penduduk.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:penduduks',
            'password' => 'required|min:6|confirmed',
            'nik' => 'required|max:16|unique:penduduks',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Penduduk
     */
    protected function create(array $data)
    {
        return Penduduk::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nik' => $data['nik'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('penduduk.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('penduduk');
    }


    protected function register(Request $request){
        $input = $request->all();
        $validator = $this->validator($input);
        if ($validator->fails())
        {
            $request->session()->flash('register_failed','Registrasi gagal!');
          return redirect(url('/penduduk/register'));
        }
        else{
            try{
                DB::beginTransaction();
                $data = $this->create($input)->toArray();
                $data['token'] = str_random(35).(string)date('YmdHis');
                $penduduk = Penduduk::find($data['id']);
                $penduduk->activation_token = $data['token'];
                if($penduduk->Administrator==null){
                    Notification::send($penduduk, new confirmationAccount($penduduk->name, $data['token']));
                }
                $penduduk->save();
                DB::Commit();
                $request->session()->flash('register_success', 'Kami sudah mengirimkan link aktivasi pada alamat email anda, silakan periksa email anda!.');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('register_failed', 'Registrasi gagal!');
            }
          
          return redirect(url('/penduduk/login'));
        }
    }

    public function confirmation($token, Request $request){
        $penduduk = Penduduk::where('activation_token', $token)->first();
        if(!is_null($penduduk)){
            try{
                DB::beginTransaction();
                $penduduk->status = 2;
                if($penduduk->Administrator!=null){
                    $penduduk->status = 6;
                }
                $penduduk->activation_token = '';
                $penduduk->save();
                $request->session()->flash('activation_sukses', 'Akun anda sudah diaktivasi, silakan login kembali!');
                DB::Commit();
            }catch(Exception $e){
                $request->session()->flash('activation_fail', 'Aktivasi Gagal!');
                DB::Rollback();
            }
        }else{
            $request->session()->flash('activation_fail', 'Aktivasi Gagal!');
        }
        return redirect(url('/penduduk/login'));
    }
}
