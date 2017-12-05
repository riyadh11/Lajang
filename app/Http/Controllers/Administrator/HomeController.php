<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Detail_Laporan;
use App\Penduduk;
use App\Kategori;
use App\Laporan;
use App\Kecamatan;
use App\Kelurahan;

class HomeController extends Controller
{

    public function index()
    {
    	$penduduk=Penduduk::withTrashed()->where('status','<','5')->get();
    	$laporan=$this->getMax(Laporan::withTrashed()->get(), 'Detail_Laporan');
    	$kategori=$this->getMax(Kategori::withTrashed()->get(), 'Laporan');
    	$penduduk2=$this->getMax($penduduk,'detail_laporan');
    	$kecamatan=$this->getMax(Kecamatan::withTrashed()->get(), 'Laporan');
    	$kelurahan=$this->getMax(Kelurahan::withTrashed()->get(), 'Laporan');
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
