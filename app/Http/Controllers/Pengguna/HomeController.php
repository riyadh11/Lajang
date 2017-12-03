<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\laporan;
use App\Kategori;
use App\Status_Laporan;

class HomeController extends Controller
{
    public function list()
    {
    	$laporan=Laporan::all();
    	return view('pengguna.listlaporan')->with(compact("laporan"));
    }

    public function show($id,Request $request)
    {
    	$exp=explode("+", $id);
	     if(count($exp)!=3){
	      return redirect('/penduduk/home'); 
	     }else{
	      $judul_laporan=$exp[0];
	      $lat=$exp[1];
	      $long=$exp[2];

	      $laporan=laporan::where(['judul_laporan'=>$judul_laporan,'lat'=>$lat,'long'=>$long])->first();
	      if($laporan==null or $laporan->trashed()){
	      	return redirect('/penduduk/home'); 
	      }else{
	       return view('pengguna.lihatlaporan')->with(compact('laporan'));
	      }
	      }
    }

    public function kategori($id, Request $request)
    {
        $kategori=Kategori::where('nama',$id)->first();
        if($kategori!=null){
            $laporan=$kategori->Laporan()->get();
            return view('pengguna.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/laporan');
        }
    }

    public function status($id, Request $request)
    {
        $status=Status_Laporan::where('nama',$id)->first();
        if($status!=null){
            $laporan=$status->Laporan()->get();
            return view('pengguna.listlaporan')->with(compact('laporan'));
        }else{
            return redirect('/laporan');
        }
    }
}
