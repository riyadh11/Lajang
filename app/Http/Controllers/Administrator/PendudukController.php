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
    	$penduduks=Penduduk::where('status','<',5)->get();
    	return view('administrator.penduduk')->with(compact('penduduks'));
    }

    public function remove($id,Request $request)
    {
        if($this->sanitize($id,'remove')){
            try{
                DB::BeginTransaction();
                $Penduduk=Penduduk::where('nik',$id)->first();
                if($Penduduk->status==6){
                    $request->session()->flash('warning','Operasi gagal!');
                    return back();
                }
                $Penduduk->delete();
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
    	return back();
    }

    public function activate($id,Request $request)
    {
        try{    
            DB::BeginTransaction();
            $Penduduk=Penduduk::where('nik',$id)->first();
            if($Penduduk->status==5){
                $Penduduk->status=6;
                $Penduduk->save();
                $request->session()->flash('success','Operasi berhasil!');
            }else{
                $request->session()->flash('warning','Operasi gagal!');
            }
            DB::Commit();
        }catch(Exception $e){
            DB::Rollback();
            $request->session()->flash('warning','Operasi gagal!');
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
        $Penduduk=Penduduk::where('nik',$id)->first();
        if($Penduduk!=null){
            $laporan=$Penduduk->Laporan->all();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/penduduk');
        }
    }

    public function list_detail($id)
    {
        $Penduduk=Penduduk::where('nik',$id)->first();
        if($Penduduk!=null){
            $laporan=$Penduduk->Komentar->all();
            return view('administrator.detaillaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/penduduk');
        }
    }
}
