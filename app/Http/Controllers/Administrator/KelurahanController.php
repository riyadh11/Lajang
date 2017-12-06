<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kelurahan;
use App\Kecamatan;
use Validator;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    protected function validatorBuatKelurahan(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:50|unique:kelurahans',
        ]);
    }

    protected function validatorUbahKelurahan(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:50',
        ]);
    }

    public function index()
    {
    	$kelurahans=Kelurahan::all();
        $kecamatans=Kecamatan::all();
    	return view('administrator.kelurahan')->with(compact('kelurahans','kecamatans'));
    }

    public function update(Request $request)
    {
        $validator=$this->validatorUbahKelurahan($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kelurahan::where('id',$request['id'])->update(['nama'=>$request['nama'],'kecamatan'=>$request['kecamatan'],'kodepos'=>$request['kodepos']]);
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
        return back();
    }

    public function store(Request $request)
    {
        $validator=$this->validatorBuatKelurahan($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kelurahan::create(['nama'=>$request['nama'],'kecamatan'=>$request['kecamatan'],'kodepos'=>$request['kodepos']]);
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
        return back();
    }

    public function remove($id,Request $request)
    {
        if($this->sanitize($id,'remove')){
            try{
                DB::BeginTransaction();
                $Kelurahan=Kelurahan::where('nama',$id)->first();
                $Kelurahan->delete();
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
    	return back();
    }
    
    public function sanitize($id,$cat)
    {
        $Kelurahan=Kelurahan::withTrashed()->where('nama',$id)->first();
        if($Kelurahan==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$Kelurahan->trashed();
                break;
            case 'activate':
                return $Kelurahan->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $Kelurahan=Kelurahan::where('nama',$id)->first();
        if($Kelurahan!=null){
            $laporan=$Kelurahan->Laporan->all();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/daerah/kelurahan');
        }
    }
}
