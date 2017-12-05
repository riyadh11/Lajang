<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Detail_laporan;
use App\Penduduk;
use App\kategori;
use App\laporan;
use App\Kecamatan;

class HomeController extends Controller
{

    public function index()
    {
    	$penduduk=Penduduk::withTrashed()->where('status','<','5')->get();
    	$laporan=$this->getMax(laporan::withTrashed()->get(), 'Detail_laporan');
    	$kategori=$this->getMax(kategori::withTrashed()->get(), 'Laporan');
    	$penduduk2=$this->getMax($penduduk,'detail_laporan');
    	$kecamatan=$this->getMax(Kecamatan::withTrashed()->get(), 'Laporan');
    	$kelurahan=$this->getMax(Kecamatan::withTrashed()->get(), 'Laporan');
      return view('administrator.home')->with(compact('penduduk','laporan','kategori','penduduk2','kecamatan','kelurahan'));
    }

    public function getMax($collection,$param)
    {
    	$tmp=$collection;
    	$int=0;

    	foreach ($tmp as $key => $value) {
    		if($value->{$param}()!=null){
    			if($value->{$param}()->count() > $int){
    				$collection=$value;
    				$int=$value->{$param}()->count();
    			}
    		}
    	}
    return $collection;
    }
}
