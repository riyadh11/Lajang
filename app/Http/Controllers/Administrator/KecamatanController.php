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

    public function index()
    {
    	$kecamatans=Kecamatan::withTrashed()->get();
    	return view('Administrator.Kecamatan')->with(compact('kecamatans'));
    }

    public function index_k($id)
    {
        $Kecamatan=Kecamatan::withTrashed()->where('nama',$id)->first();
        $kecamatans=Kecamatan::all();
        if($Kecamatan!=null){
            $kelurahans=$Kecamatan->kelurahan()->withTrashed()->get();
            return view('administrator.kelurahan')->with(compact('kelurahans','kecamatans'));
        }else{
            return redirect('/administrator/daerah/kecamatan');
        }
    }

    public function update(Request $request)
    {
        $validator=$this->validatorBuatKecamatan($request->toArray());
        if($validator->fails()){

        }else{
            try{
                DB::BeginTransaction();
                Kecamatan::where('id',$request['id'])->update(['nama'=>$request['nama']]);
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
        return back();
    }

    public function store(Request $request)
    {
        $validator=$this->validatorBuatKecamatan($request->toArray());
        if($validator->fails()){

        }else{
            try{
                DB::BeginTransaction();
                Kecamatan::create(['nama'=>$request['nama']]);
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
        return back();
    }

    public function remove($id)
    {
        if($this->sanitize($id,'remove')){
            try{
                DB::BeginTransaction();
                $Kecamatan=Kecamatan::where('nama',$id)->first();
                $Kecamatan->delete();
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
                $Kecamatan=Kecamatan::withTrashed()->where('nama',$id)->first();
                $Kecamatan->restore();
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
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
        $Kecamatan=Kecamatan::withTrashed()->where('nama',$id)->first();
        if($Kecamatan!=null){
            $laporan=$Kecamatan->laporan();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/daerah/kecamatan');
        }
    }
}
