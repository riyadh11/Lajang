<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Laporan;;
use App\Komentar;
use App\Penduduk;
use App\Notifications\notifyProgress;

class KomentarController extends Controller
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
       $laporan=Laporan::find($request['id']);
       if($penduduk==null or $laporan==null){
         $request->session()->flash('warning','Tidak ada yang bisa disimpan!');
         return back();
       }
       if($laporan->status==4){
          $request->session()->flash('warning','Laporan sudah selesai!');
          return back();
        }
        $Komentar=$laporan->Komentar()->create(['penduduk'=>$penduduk->id, 'komentar'=>$request['komentar']]);
        if($request->hasfile('foto')){
         $files = $request->file('foto');
         foreach ($files as $step=> $foto) {
          $data = array('foto' => $foto );
          $validator=$this->validatorGambar($data);
          if($validator->fails()){
           DB::rollback();
          }
          $ext=$request['foto'][$step]->getClientOriginalExtension();
          $nama_file='progress-'.md5($Komentar->id).'-'.time().$step.'.'.$ext;
          $nama_folder='laporan_'.md5($laporan->id).'_'.$laporan->judul_laporan.'/';
          Storage::disk('data-laporan')->put($nama_folder.$nama_file , File::get($request['foto'][$step]));
          $Komentar->foto_laporan()->create(['url_gambar'=>$nama_folder.$nama_file]);
         }
        }
       $pelapor=$laporan->Penduduk;
       Notification::send($pelapor, new notifyProgress($pelapor->name,$laporan->judul_laporan,$Komentar->komentar));
       DB::commit();
      }catch(Exception $e){
       DB::rollback();
      }
       return back(); 
    }

    public function update(Request $request)
    {
      $penduduk=Penduduk::find(\Auth::user()->id);
      $data=Komentar::where(['id'=>$request['id'],'laporan'=>$request['id-laporan'],'penduduk'=>$penduduk->id])->first();
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

    public function remove($id,Request $request)
    {
      try{
        DB::beginTransaction();
        $penduduk=Penduduk::find(\Auth::user()->id);
        $data=Komentar::where(['id'=>$id,'penduduk'=>$penduduk->id])->first();
        if($data->Laporan->status==4){
        $request->session()->flash('warning','Laporan sudah selesai!');
        return back();
        }
        Komentar::where(['id'=>$id])->delete();
        DB::commit();
         $request->session()->flash('success','Operasi sukses!');
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

}
