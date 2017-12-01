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
        return back(); 
       }
      try{
       DB::beginTransaction();
       $penduduk=Penduduk::find(\Auth::user()->id);
       $laporan=Detail_laporan::find($request['detail_laporan']);
        $detail_laporan=$laporan->vote()->firstOrNew(['voter'=>\Auth::user()->id]);
        $detail_laporan->like=$request['like'];
        $detail_laporan->save();
       DB::commit();
      }catch(Exception $e){
       DB::rollback();
      }
       return back(); 
    }

}
