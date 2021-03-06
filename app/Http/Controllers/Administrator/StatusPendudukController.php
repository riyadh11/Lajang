<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Status_Penduduk;
use Validator;
use Illuminate\Support\Facades\DB;

class StatusPendudukController extends Controller
{
    protected function validatorBuatStatus_penduduk(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:20|unique:status_penduduks',
            'deskripsi' => 'required|max:100',
        ]);
    }

    protected function validatorUbahStatus_penduduk(array $data)
    {
        return Validator::make($data, [
            'id'=>'required|exists:status_penduduks,id',
            'nama' => 'required|max:20',
            'deskripsi' => 'required|max:100',
        ]);
    }

    public function index()
    {
    	$Status_penduduks=Status_Penduduk::all();
    	return view('administrator.statuspenduduk')->with(compact('Status_penduduks'));
    }

    public function update(Request $request)
    {
        $validator=$this->validatorUbahStatus_penduduk($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Status_Penduduk::where('id',$request['id'])->update(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi']]);
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
        $validator=$this->validatorBuatStatus_penduduk($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Status_Penduduk::create(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi']]);
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
        return back();
    }

    public function remove($id,Request $request)
    {
        if($this->sanitize($id,'remove')){
            try{
                DB::BeginTransaction();
                $Status_penduduk=Status_Penduduk::where('nama',$id)->first();
                $Status_penduduk->delete();
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
    	return back();
    }

    public function sanitize($id,$cat)
    {
        $Status_penduduk=Status_Penduduk::withTrashed()->where('nama',$id)->first();
        if($Status_penduduk==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$Status_penduduk->trashed();
                break;
            case 'activate':
                return $Status_penduduk->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $Status=Status_Penduduk::where('nama',$id)->first();
        if($Status!=null){
            $penduduks=$Status->Penduduk()->withTrashed()->get();
            return view('administrator.penduduk')->with(compact('penduduks'));
        }else{
            return redirect('/administrator/penduduk');
        }
    }
}
