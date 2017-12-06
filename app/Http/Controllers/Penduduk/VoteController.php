<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Komentar;
use App\Penduduk;

class VoteController extends Controller
{

    protected function validatorVote(array $data)
  	{
  		return Validator::make($data, [

            'id' => 'required|exists:komentars,id',
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
       $laporan=Komentar::find($request['id']);
       if($penduduk==null or $laporan==null or $laporan->penduduk == $penduduk->id){
        $request->session()->flash('warning','Operasi tidak diperbolehkan!');
        return back();
       }
      try{
       DB::beginTransaction();
        $Komentar=$laporan->Vote()->firstOrNew(['voter'=>\Auth::user()->id]);
        $Komentar->like=$request['like'];
        $Komentar->save();
       DB::commit();
       $request->session()->flash('success','Vote sukses!');
      }catch(Exception $e){
       DB::rollback();
      }
       return back(); 
    }

}
