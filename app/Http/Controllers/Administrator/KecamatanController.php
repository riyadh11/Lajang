<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kecamatan;
use Validator;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    protected function validatorBuatKecamatan(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:50|unique:kecamatans',
        ]);
    }

    protected function validatorUbahKecamatan(array $data)
    {
        return Validator::make($data, [
            'id'=>'required|exists:kecamatans,id',
            'nama' => 'required|max:50',
        ]);
    }

    public function index()
    {
    	$kecamatans=Kecamatan::all();
    	return view('administrator.kecamatan')->with(compact('kecamatans'));
    }

    public function index_k($id)
    {
        $Kecamatan=Kecamatan::where('nama',$id)->first();
        $kecamatans=Kecamatan::all();
        if($Kecamatan!=null){
            $kelurahans=$Kecamatan->Kelurahan()->get();
            return view('administrator.kelurahan')->with(compact('kelurahans','kecamatans'));
        }else{
            return redirect('/administrator/daerah/kecamatan');
        }
    }

    public function update(Request $request)
    {
        $validator=$this->validatorUbahKecamatan($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kecamatan::where('id',$request['id'])->update(['nama'=>$request['nama']]);
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
        $validator=$this->validatorBuatKecamatan($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kecamatan::create(['nama'=>$request['nama']]);
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
                $Kecamatan=Kecamatan::where('nama',$id)->first();
                $Kecamatan->delete();
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
        $Kecamatan=Kecamatan::withTrashed()->where('nama',$id)->first();
        if($Kecamatan==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$Kecamatan->trashed();
                break;
            case 'activate':
                return $Kecamatan->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $Kecamatan=Kecamatan::where('nama',$id)->first();
        if($Kecamatan!=null){
            $laporan=$Kecamatan->Laporan();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/daerah/kecamatan');
        }
    }
}
