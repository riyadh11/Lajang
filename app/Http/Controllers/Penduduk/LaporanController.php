<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Laporan;
use App\Penduduk;
use App\Kelurahan;
use App\Kategori;

class LaporanController extends Controller
{

  	protected function validatorBuatLaporan(array $data)
  	{
  		return Validator::make($data, [

            'judul_laporan' => 'required|max:50',
            'lat' => 'required|numeric|max:200',
            'long' => 'required|numeric|max:200'
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
      $laporan=\Auth::user()->Laporan->all();
      return view('penduduk.listlaporan')->with(compact('laporan'));
    }  


    public function gstore()
    {
      $kategoris=Kategori::all();
      return view('penduduk.buatlaporan')->with(compact('kategoris'));
    }

    public function store(Request $request)
    {
    	 $validator = $this->validatorBuatLaporan($request->toArray());
    	 if($validator->fails()){
        $request->session()->flash('warning','Input tidak valid!');
        return back();
    	 }
      
      $locate=$this->locate($request['lat'],$request['long']);
      $kelurahan=Kelurahan::where('kodepos',$locate['kodepos'])->first();
      if($kelurahan==null){
        $request->session()->flash('warning', 'Area diluar malang!');
        return back();
      }
      try{
       DB::beginTransaction();
       $penduduk=Penduduk::find(\Auth::user()->id);
       $laporan=$penduduk->Laporan()->create(['judul_laporan'=>$request['judul_laporan'], 'lat'=>$request['lat'], 'long'=>$request['long'],'pelapor'=>\Auth::user()->id, 'kategori'=>$request['kategori'],'alamat' => $locate['alamat'],'kelurahan'=>$kelurahan->id]);
       $Komentar=$laporan->Komentar()->create(['penduduk'=>\Auth::user()->id, 'komentar'=>$request['deskripsi']]);
        
        if($request->hasfile('foto')){
         $files = $request->file('foto');
         foreach ($files as $step=> $foto) {
          $data = array('foto' => $foto );
          $validator=$this->validatorGambar($data);
          if($validator->fails()){
           $request->session()->flash('warning','Input Gambar tidak valid!');
           DB::rollback();
           return back();
          }
          $ext=$request['foto'][$step]->getClientOriginalExtension();
          $nama_file='progress-'.md5($Komentar->id).'-'.time().$step.'.'.$ext;
          $nama_folder='laporan_'.md5($laporan->id).'_'.$laporan->judul_laporan.'/';
          Storage::disk('data-laporan')->put($nama_folder.$nama_file , File::get($request['foto'][$step]));
          $Komentar->Foto_Laporan()->create(['url_gambar'=>$nama_folder.$nama_file]);
         }
        }
       DB::commit();
       $request->session()->flash('success', 'Laporan berhasil ditambahkan');
      }catch(Exception $e){
       DB::rollback();
       $request->session()->flash('warning','Gagal memasukkan ke database');
      }
       
       return back();
    }

    public function gupdate($id, Request $request)
    {
     $exp=explode("+", $id);
     if(count($exp)!=3){
      return redirect('/penduduk/home'); 
     }else{
      $judul_laporan=$exp[0];
      $lat=$exp[1];
      $long=$exp[2];

      $laporan=laporan::where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long, 'pelapor' => \Auth::user()->id])->first();
      $kategoris=Kategori::all();
      if($laporan==null){
       return redirect('/penduduk/home'); 
       $request->session()->flash('warning', 'Laporan tidak ditemukan!');
      }elseif($laporan->status!=1){
        $request->session()->flash('warning', 'Laporan sedang ditangani!');
        return back();
      }else{
       return view('penduduk.editlaporan')->with(compact('laporan','kategoris'));
      }
      }

    }

    public function update(Request $request)
    {
     $validator = $this->validatorBuatLaporan($request->toArray());
      if($validator->fails()){
        $request->session()->flash('warning','Input tidak valid!');
        return back();
      }
      $locate=$this->locate($request['lat'],$request['long']);
      $kelurahan=Kelurahan::where('kodepos',$locate['kodepos'])->first();
      if($kelurahan==null){
        $request->session()->flash('warning', 'Area diluar malang!');
        return back();
      }
      if(laporan::find($request['id'])->status!=1){
        $request->session()->flash('warning', 'Laporan sedang ditangani!');
        return back();
      }
      try{
       DB::beginTransaction();
       $penduduk=Penduduk::find(\Auth::user()->id);
       $laporan=$penduduk->Laporan()->where('id',$request['id'])->update(['judul_laporan'=>$request['judul_laporan'], 'lat'=>$request['lat'], 'long'=>$request['long'],'pelapor'=>\Auth::user()->id, 'kategori'=>$request['kategori'],'alamat' => $locate['alamat'], 'kelurahan'=>$kelurahan->id]);
       $detail=laporan::find($request['id'])->Komentar->first();
       $detail->komentar=$request['deskripsi'];
       $detail->save();
       DB::commit();
       $request->session()->flash('success', 'Laporan berhasil diubah');
      }catch(Exception $e){
       DB::rollback();
       $request->session()->flash('warning','Gagal memasukkan ke database');
      }
       
       return back();
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


}
