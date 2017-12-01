<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\laporan;
use App\Kategori;
use App\Penduduk;
use App\Kelurahan;
use App\Status_Laporan;

class LaporanController extends Controller
{

  	protected function validatorBuatLaporan(array $data)
  	{
  		return Validator::make($data, [

            'judul_laporan' => 'required|max:50',
            'lat' => 'required|max:100',
            'long' => 'required|max:100',
            'status' => 'required|numeric|min:1|max:5',
            'kategori' => 'required|numeric|min:1|max:10'
        ]);
  	}

    protected function validatorGambar(array $data)
    {
      return Validator::make($data, [
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
    }


    public function list()
    {
      $laporan=Laporan::withTrashed()->get();
      return view('administrator.listlaporan')->with(compact('laporan'));
    }   

    public function gupdate($id, Request $request)
    {
      $exp=explode("+", $id);
      if(count($exp)!=3){
        $request->session()->flash('status','Tidak ditemukan!');
        return redirect('/administrator/laporan'); 
      }else{
        $judul_laporan=$exp[0];
        $lat=$exp[1];
        $long=$exp[2];
        $laporan=laporan::where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
        $kategoris=Kategori::all();
        $statuses=Status_Laporan::all();
        if($laporan==null or $laporan->trashed()){
          $request->session()->flash('warning','Laporan tidak aktif!');
          return redirect('/administrator/laporan'); 
        }elseif($laporan->status==4){
          $request->session()->flash('warning','Laporan sudah selesai!');
          return redirect('/administrator/laporan'); 
        }else{
          return view('administrator.editLaporan')->with(compact('laporan','kategoris','statuses'));
        }
      }

    }

    public function update(Request $request)
    {
     $validator = $this->validatorBuatLaporan($request->toArray());
      if($validator->fails()){
        $request->session()->flash('warning', 'Input tidak valid');
        return back();
      }
      $locate=$this->locate($request['lat'],$request['long']);
      $kelurahan=Kelurahan::where('kodepos',$locate['kodepos'])->first();
      if($kelurahan==null){
        $request->session()->flash('warning', 'Area diluar malang!');
        return back();
      }
      if($request['status']==1){
        $request->session()->flash('warning', 'Tidak boleh kembali ke status awal!');
        return back();
      }
      if(laporan::find($request['id'])->status==4){
        $request->session()->flash('warning', 'Laporan sudah selesai!');
        return back();
      }
      try{
       DB::beginTransaction();
       $laporan=Laporan::where('id',$request['id'])->update(['judul_laporan'=>$request['judul_laporan'], 'lat'=>$request['lat'], 'long'=>$request['long'],'alamat'=>$locate['alamat'], 'kategori'=>$request['kategori'], 'kelurahan'=>$kelurahan->id, 'status' => $request['status']]);
       $detail=laporan::find($request['id'])->detail_laporan->first();
       $detail->komentar=$request['deskripsi'];
       $detail->save();
       DB::commit();
       $request->session()->flash('success', 'Laporan berhasil diubah');
      }catch(Exception $e){
       DB::rollback();
       $request->session()->flash('warning', 'Gagal memasukkan ke database');
      }
       
       return back();
    }

    public function show($id, Request $request)
    {
      $exp=explode("+", $id);
       if(count($exp)!=3){
        $request->session()->flash('status','Tidak ditemukan!');
        return redirect('/penduduk/home'); 
       }else{
        $judul_laporan=$exp[0];
        $lat=$exp[1];
        $long=$exp[2];

        $laporan=laporan::where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
        if($laporan==null or $laporan->trashed()){
         $request->session()->flash('status','Tidak ditemukan!');
         return back();
        }else{
          if($laporan->status==1){
            $laporan->status=2;
            $laporan->save();
          }
         return view('administrator.lihatlaporan')->with(compact('laporan'));
        }
        }
    }

    public function locate($lat, $lng)
    {
      $api="AIzaSyAkyfFW3F5aBH55Pqa88U76nSAJoO6KUVE";
      $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=".$api;
      $content = file_get_contents($url);
      $json = json_decode($content, true);
      $data=$json['results']['0']['formatted_address'];
      $data2=$json['results']['0']['address_components'];
      foreach ($data2 as $tmp) {
        if($tmp['types']['0']=="postal_code"){
          $data2=$tmp['short_name'];
          break;
        }
      }
      $location = array('alamat' => $data,'kodepos' => $data2 );
      return $location;
    }

    public function remove($id,Request $request)
    {
      $exp=explode("+", $id);
       if(count($exp)!=3){
        $request->session()->flash('status','Tidak ditemukan!');
        return redirect('/administrator/home'); 
       }else{
        $judul_laporan=$exp[0];
        $lat=$exp[1];
        $long=$exp[2];
        try{
          DB::beginTransaction();
          $laporan=laporan::withTrashed()->where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
          $laporan->delete();
          DB::commit();
          $request->session()->flash('success','Operasi berhasil!');
        }catch(Exception $e){
          DB::rollback();
          $request->session()->flash('warning','Operasi gagal!');
        }
        return back();
        }
    }

    public function activate($id,Request $request)
    {
      $exp=explode("+", $id);
       if(count($exp)!=3){
        $request->session()->flash('status','Tidak ditemukan!');
        return redirect('/administrator/home'); 
       }else{
        $judul_laporan=$exp[0];
        $lat=$exp[1];
        $long=$exp[2];
        try{
          DB::beginTransaction();
          $laporan=laporan::withTrashed()->where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
          $laporan->restore();
          DB::commit();
          $request->session()->flash('success','Operasi berhasil!');
        }catch(Exception $e){
          DB::rollback();
          $request->session()->flash('warning','Operasi gagal!');
        }
        return back();
        }
      
    }

}
