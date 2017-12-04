<?php

namespace App\Http\Controllers\AdministratorAuth;

use App\Administrator;
use App\Penduduk;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\registerAdministrator;

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
    protected $redirectTo = '/administrator/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('administrator.guest');
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
            'nik' => 'required|max:16|unique:penduduks',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Administrator
     */
    protected function create(array $data)
    {
        $penduduk=$this->createPenduduk($data);

        return Administrator::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'penduduk' => $penduduk->id,
        ]);
    }

    public function createPenduduk(array $data)
    {
        return Penduduk::create([
            'name' => $data['name'],
            'email' => $data['nik'].'.admin.'.$data['email'],
            'nik' => $data['nik'],
            'status' => '5',
            'password' => bcrypt(rand(1111111111,999999999).$data['name'].$data['nik'].rand(00000000,99999999)),
        ]);
    }


    protected function register(Request $request){
        $input = $request->all();
        $validator = $this->validator($input);
        if ($validator->fails())
        {
            $request->session()->flash('register_failed','Registrasi gagal!');
            return redirect(url('/administrator/register'));
        }
        else{
            try{
                DB::beginTransaction();
                $data = $this->create($input)->toArray();
                $administrator = Administrator::find($data['id']);
                Notification::send($administrator, new registerAdministrator($administrator->name));
                DB::Commit();
                $request->session()->flash('register_success', 'Kami sudah mengirimkan notifikasi pada alamat email anda, silakan periksa email anda!.');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('register_failed', 'Registrasi gagal!');
            }
          
          return redirect(url('/administrator/login'));
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('administrator.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('administrator');
    }
}
