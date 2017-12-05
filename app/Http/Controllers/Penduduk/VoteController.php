<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Detail_Laporan;
use App\Penduduk;

class VoteController extends Controller
{

    protected function validatorVote(array $data)
  	{
  		return Validator::make($data, [

            'detail_laporan' => 'required|exists:detail_laporans,id',
            'like' => 'required|boolean',
        ]);
  	}

    public function store(Request $request)
    {
      $validator = $this->validatorVote($request->toArray());
       if($validator->fails()){
        $request->session()->flash('warning','Input vote tidak diperbolehkan!');
        return back(); 
       }
       $penduduk=Penduduk::find(\Auth::user()->id);
       $laporan=Detail_Laporan::find($request['detail_laporan']);
       if($penduduk==null or $laporan==null or $laporan->penduduk == $penduduk->id){
        $request->session()->flash('warning','Operasi tidak diperbolehkan!');
        return back();
       }
      try{
       DB::beginTransaction();
        $detail_laporan=$laporan->Vote()->firstOrNew(['voter'=>\Auth::user()->id]);
        $detail_laporan->like=$request['like'];
        $detail_laporan->save();
       DB::commit();
       $request->session()->flash('success','Vote sukses!');
      }catch(Exception $e){
       DB::rollback();
      }
       return back(); 
    }

}
