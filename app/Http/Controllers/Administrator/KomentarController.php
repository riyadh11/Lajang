<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Laporan;
use App\Komentar;
use App\Penduduk;
use App\Notifications\notifyProgress;

class KomentarController extends Controller
{

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
       $penduduk=Penduduk::find(\Auth::user()->penduduk);
       $laporan=Laporan::find($request['Komentar']);
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

    public function remove($id,Request $request)
    {
      try{
        DB::beginTransaction();
        Komentar::where(['id'=>$id])->delete();
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

    public function update(Request $request)
    {
      try{
        DB::beginTransaction();
        $data=Komentar::where(['id'=>$request['id'],'laporan'=>$request['id-laporan']])->first();
        $data->update(['komentar'=>$request['komentar']]);
        if($data->Laporan->status==4){
        $request->session()->flash('warning','Laporan sudah selesai!');
        DB::rollback();
        return back();
        }
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
      }
      return back();
    }

}
