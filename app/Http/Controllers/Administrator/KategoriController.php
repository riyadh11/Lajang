<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;
use Validator;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    protected function validatorBuatKategori(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:20|unique:kategoris',
            'deskripsi' => 'required|max:100',
        ]);
    }

    protected function validatorUbahKategori(array $data)
    {
        return Validator::make($data, [
            'id'=>'required|exists:kategoris,id',
            'nama' => 'required|max:20',
            'deskripsi' => 'required|max:100',
        ]);
    }

    public function index()
    {
    	$kategoris=Kategori::all();
    	return view('administrator.kategori')->with(compact('kategoris'));
    }

    public function update(Request $request)
    {
        $validator=$this->validatorUbahKategori($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kategori::where('id',$request['id'])->update(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi']]);
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
        $validator=$this->validatorBuatKategori($request->toArray());
        if($validator->fails()){
            $request->session()->flash('warning','Operasi gagal!');
        }else{
            try{
                DB::BeginTransaction();
                Kategori::create(['nama'=>$request['nama'],'deskripsi'=>$request['deskripsi']]);
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
                $kategori=Kategori::where('nama',$id)->first();
                $kategori->delete();
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
    	return back();
    }


///////////////////////////////////////////////
/////// FUNGSI INI SUDAH TIDAK DIPAKAI ////////

    public function activate($id,Request $request)
    {
        if($this->sanitize($id,'activate')){
            try{
                DB::BeginTransaction();
                $kategori=Kategori::withTrashed()->where('nama',$id)->first();
                $kategori->restore();
                DB::Commit();
                $request->session()->flash('success','Operasi berhasil!');
            }catch(Exception $e){
                DB::Rollback();
                $request->session()->flash('warning','Operasi gagal!');
            }
        }
    	return back();
    }

/////// FUNGSI INI SUDAH TIDAK DIPAKAI ////////
/////////////////////////////////////////////

    
    public function sanitize($id,$cat)
    {
        $kategori=Kategori::withTrashed()->where('nama',$id)->first();
        if($kategori==null){
            return false;
        }
        switch ($cat) {
            case 'remove':
                return !$kategori->trashed();
                break;
            case 'activate':
                return $kategori->trashed();
                break;
            dafault:
                return false;
        }
    }

    public function list($id)
    {
        $kategori=Kategori::where('nama',$id)->first();
        if($kategori!=null){
            $laporan=$kategori->Laporan()->withTrashed()->get();
            return view('administrator.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/administrator/status/laporan');
        }
    }
}
