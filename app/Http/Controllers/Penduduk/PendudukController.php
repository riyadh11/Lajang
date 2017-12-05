<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Detail_laporan;
use App\Penduduk;

class PendudukController extends Controller
{
    public function index()
    {
      $penduduk=\Auth::guard('penduduk')->user();
      return view('penduduk.profile')->with(compact('penduduk'));
    }

    public function update(Request $request)
    {
    	$penduduk=\Auth::guard('penduduk')->user();
    	if($request->hasFile('foto')){
    		try{
    			DB::beginTransaction();
    			$ext=$request['foto']->getClientOriginalExtension();
    			$nama_file='foto-'.md5($penduduk->name).'-'.time().'.'.$ext;
    			$nama_folder='foto_'.md5($penduduk->id).'/';
    			Storage::disk('data-penduduk')->put($nama_folder.$nama_file , File::get($request['foto']));
    			$penduduk->url_foto=$nama_folder.$nama_file;
    			$penduduk->save();
    			DB::commit();
    			$request->session()->flash('success','sukses ubah foto profil');
    		}catch(Exception $e){
    			DB::rollback();
    			$request->session()->flash('warning','gagal ubah foto profil');
    		}
    	}

    	return redirect('/penduduk/profil');
    }


}
