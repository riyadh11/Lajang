<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Penduduk;
use Validator;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    public function index()
    {
    	$penduduks=Penduduk::withTrashed()->where('status','<',5)->get();
    	return view('Administrator.Penduduk')->with(compact('penduduks'));
    }

    public function remove($id)
    {
        if($this->sanitize($id,'remove')){
            try{
                DB::BeginTransaction();
                $Penduduk=Penduduk::where('nik',$id)->first();
                $Penduduk->delete();
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
    	return back();
    }

    public function activate($id)
    {
        if($this->sanitize($id,'activate')){
            try{
                DB::BeginTransaction();
                $Penduduk=Penduduk::withTrashed()->where('nik',$id)->first();
                $Penduduk->restore();
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
    	return back();
    }

    public function sanitize($id,$cat)
    {
        $Penduduk=Penduduk::withTrashed()->where('nik',$id)->first();
        if($Penduduk==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$Penduduk->trashed();
                break;
            case 'activate':
                return $Penduduk->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $Penduduk=Penduduk::withTrashed()->where('nik',$id)->first();
        if($Penduduk!=null){
            $laporan=$Penduduk->laporan->all();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/penduduk');
        }
    }
}
