@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in as Administrator!
                <br>
                <br>
                <h5><strong>Daftar Fitur Admin</strong></h5>
                <ul>
                    <li><a href="/administrator/daerah/kecamatan">Daerah Kecamatan</a></li>
                    <li><a href="/administrator/daerah/kelurahan">Daerah Kelurahan</a></li>
                    <li><a href="/administrator/status/penduduk">Status Penduduk</a></li>
                    <li><a href="/administrator/status/laporan">Status Laporan</a></li>
                    <li><a href="/administrator/laporan">Laporan</a></li>
                    <li><a href="/administrator/penduduk">Penduduk</a></li>
                    <li><a href="/administrator/profil">Profil</a></li>
                </ul>
                <br>
                <br>
                <h5><strong>Statistik</strong></h5>
                Penduduk Terdaftar : {{$penduduk->count()}}
                <br>
                Penduduk Paling aktif : {{$penduduk2->name}} ({{$penduduk2->Komentar->count()}})
                <br>
                Kategori Paling sering : {{$kategori->nama}} ({{$kategori->laporan->count()}})
                <br>
                Laporan Paling rame : {{$laporan->judul_laporan}} ({{$laporan->Komentar->count()}})
                <br>
                Kecamatan paling sering : {{$kecamatan->nama}} ({{$kecamatan->laporan()->count()}})
                <br>
                Kelurahan paling sering : {{$kelurahan->nama}} ({{$kelurahan->laporan()->count()}})
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
