<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Status_laporan;
use Validator;
use Illuminate\Support\Facades\DB;

class StatusLaporanController extends Controller
{
    protected function validatorBuatStatus_laporan(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:20|unique:status_laporans',
            'deskripsi' => 'required|max:100',
        ]);
    }

    public function index()
    {
    	$Status_laporans=Status_laporan::withTrashed()->get();
    	return view('Administrator.StatusLaporan')->with(compact('Status_laporans'));
    }

    public function update(Request $request)
    {
        $validator=$this->validatorBuatStatus_laporan($request->toArray());
        if($validator->fails()){

        }else{
            try{
                DB::BeginTransaction();
                Status_laporan::where('id',$request['id'])->update(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi'], 'icon'=>$request['icon']]);
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
        return back();
    }

    public function store(Request $request)
    {
        $validator=$this->validatorBuatStatus_laporan($request->toArray());
        if($validator->fails()){

        }else{
            try{
                DB::BeginTransaction();
                Status_laporan::create(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi'],'icon'=>$request['icon']]);
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
                $Status_laporan=Status_laporan::where('nama',$id)->first();
                $Status_laporan->delete();
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
                $Status_laporan=Status_laporan::withTrashed()->where('nama',$id)->first();
                $Status_laporan->restore();
                DB::Commit();
            }catch(Exception $e){
                DB::Rollback();
            }
        }
    	return back();
    }

    public function sanitize($id,$cat)
    {
        $Status_laporan=Status_laporan::withTrashed()->where('nama',$id)->first();
        if($Status_laporan==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$Status_laporan->trashed();
                break;
            case 'activate':
                return $Status_laporan->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $Status_laporan=Status_laporan::withTrashed()->where('nama',$id)->first();
        if($Status_laporan!=null){
            $laporan=$Status_laporan->Laporan()->withTrashed()->get();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/status/laporan');
        }
    }
}
