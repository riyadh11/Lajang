@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Penduduk</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>E-Mail</th>
                            <th>Status</th>
                            <th>Reputasi</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($penduduks as $step=>$penduduk)
                            <tr>
                            <td>{{$step+1}}</td>
                            <td>{{$penduduk->name}}</td>
                            <td>{{$penduduk->nik}}</td>
                            <td>{{$penduduk->email}}</td>
                            <td>{{$penduduk->Status->nama}}</td>
                            <td>{{$penduduk->reputation().'%'}}</td>
                            <td>
                                @if($penduduk->trashed())
                                <a href="/administrator/penduduk/aktivasi/{{$penduduk->nik}}"><button class="btn btn-info">Aktivasi</button></a>
                                @else
                                <a href="/administrator/penduduk/hapus/{{$penduduk->nik}}"><button class="btn btn-danger">Banned</button></a>
                                @endif
                                <a href="/administrator/penduduk/{{$penduduk->nik}}"><button class="btn btn-default">Lihat Laporan</button></a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
