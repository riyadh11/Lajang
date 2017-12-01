<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\laporan;
use App\Penduduk;

class DetailLaporanController extends Controller
{

    protected function validatorBuatLaporan(array $data)
  	{
  		return Validator::make($data, [

            'judul_laporan' => 'required|max:50',
            'lat' => 'required|max:100',
            'long' => 'required|max:100'
        ]);
  	}

    protected function validatorGambar(array $data)
    {
      return Validator::make($data, [
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
    }

    public function store(Request $request)
    {
      try{
       DB::beginTransaction();
       $penduduk=Penduduk::find(\Auth::user()->id);
       $laporan=Laporan::find($request['detail_laporan']);
        $detail_laporan=$laporan->detail_laporan()->create(['penduduk'=>$penduduk->id, 'komentar'=>$request['komentar']]);
        if($request->hasfile('foto')){
         $files = $request->file('foto');
         foreach ($files as $step=> $foto) {
          $data = array('foto' => $foto );
          $validator=$this->validatorGambar($data);
          if($validator->fails()){
           DB::rollback();
          }
          $ext=$request['foto'][$step]->getClientOriginalExtension();
          $nama_file='progress-'.md5($detail_laporan->id).'-'.time().$step.'.'.$ext;
          $nama_folder='laporan_'.md5($laporan->id).'_'.$laporan->judul_laporan.'/';
          Storage::disk('data-laporan')->put($nama_folder.$nama_file , File::get($request['foto'][$step]));
          $detail_laporan->foto_laporan()->create(['url_gambar'=>$nama_folder.$nama_file]);
         }
        }
       DB::commit();
      }catch(Exception $e){
       DB::rollback();
      }
       return back(); 
    }

    public function remove($id,Request $request)
    {
      try{
        DB::beginTransaction();
        $penduduk=Penduduk::find(\Auth::user()->id);
        $penduduk->detail_laporan()->where(['id'=>$id,'delete'=>0])->delete();
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

}
