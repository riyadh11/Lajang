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

class HomeController extends Controller
{
    public function index()
    {
      return view('penduduk.Home');
    }
}
