<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Administrator\LaporanController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\laporan;
use App\Kategori;
use App\Penduduk;
use App\Kelurahan;
use App\Status_Laporan;
use App\Administrator;

class PertanggungJawabanController extends LaporanController
{

    protected function validatorBuatLPJ(array $data)
    {
      return Validator::make($data, [
            'keterangan' => 'required',
            'kendala' => 'required',
            'solusi' => 'required',
            'laporan' => 'required|exists:laporans,id'
        ]);
    }

    protected function validatorBuatBiaya(array $data)
    {
      return Validator::make($data, [
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'unit' => 'required|min:0',
            'harga' => 'required|min:0|max:999999999999999999'
        ]);
    }

    public function show($id, Request $request)
    {
       $exp=explode("+", $id);
       if(count($exp)!=3){
        $request->session()->flash('status','Tidak ditemukan!');
        return redirect('/penduduk/home'); 
       }else{
        $lpj=true;
        $judul_laporan=$exp[0];
        $lat=$exp[1];
        $long=$exp[2];

        $laporan=laporan::where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
        if($laporan==null or $laporan->trashed()){
         $request->session()->flash('status','Tidak ditemukan!');
         return back();
        }else if($laporan->status!=4){
          $request->session()->flash('warning','LPJ Belum boleh dibuat!');
         return back();
        }else if($laporan->pertanggungjawaban!=null){
          $lpj=false;
        }
        return view('administrator.pertanggungjawaban')->with(compact('lpj','laporan'));
        }
    }

    public function store(Request $request)
    {
      $laporan=laporan::find($request['laporan']);
      $validatorBuat=$this->validatorBuatLPJ($request->toArray());
      if($validatorBuat->fails()){
        $request->session()->flash('warning','Input tidak valid!');
         return back();
      }

      if($laporan==null){
        $request->session()->flash('status','Tidak ditemukan!');
         return back();
      }
      try{
        DB::beginTransaction();
        $administrator=Administrator::find(\Auth::user()->id);
        $pertanggungjawaban= $administrator->PertanggungJawaban()->create(['laporan'=>$request['laporan'],'keterangan'=>$request['keterangan'],'kendala'=>$request['kendala'],'solusi'=>$request['solusi']]);
        $biaya=$request['nama'];
        foreach ($biaya as $step => $value) {
          $data=array('nama'=>$request['nama'][$step], 'deskripsi'=>$request['deskripsi'][$step], 'unit'=>$request['unit'][$step], 'harga'=>$request['harga'][$step]);
          $validatorBuatBiaya=$this->validatorBuatBiaya($data);
          if(!$validatorBuatBiaya->fails()){
            $pertanggungjawaban->Biaya()->create($data);
          }
        }
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

}
