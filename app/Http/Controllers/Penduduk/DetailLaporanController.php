<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\laporan;
use App\Detail_laporan;
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
       if($penduduk==null or $laporan==null){
         $request->session()->flash('warning','Tidak ada yang bisa disimpan!');
         return back();
       }
       if($laporan->status==4){
          $request->session()->flash('warning','Laporan sudah selesai!');
          return back();
        }
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
      $penduduk=Penduduk::find(\Auth::user()->id);
      $laporan=$penduduk->detail_laporan()->where('id', $id)->first();
      if($penduduk==null or $laporan==null){
         $request->session()->flash('warning','Tidak ada yang bisa dihapus!');
         return back();
      }
      if($data->Laporan->status==4){
        $request->session()->flash('warning','Laporan sudah selesai!');
        return back();
      }
      try{
        DB::beginTransaction();
        $laporan->delete();
        $request->session()->flash('success','Operasi sukses!');
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

    public function update(Request $request)
    {
      $penduduk=Penduduk::find(\Auth::user()->id);
      $data=Detail_laporan::where(['id'=>$request['id'],'laporan'=>$request['id-laporan'],'penduduk'=>$penduduk->id])->first();
      if($penduduk==null or $data==null){
        $request->session()->flash('warning','Tidak ada yang bisa diubah!');
        return back();
      }
      if($data->Laporan->status==4){
        $request->session()->flash('warning','Laporan sudah selesai!');
        return back();
      }
      try{
        DB::beginTransaction();
        $data->update(['komentar'=>$request['komentar']]);
        DB::commit();
        $request->session()->flash('success','Operasi sukses!');
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

}
