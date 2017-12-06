@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Laporan</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Judul</th>
                            <th>Komentar</th>
                            <th>Reputasi</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $lapor)
                            <tr>
                            <td>{{$lapor->Laporan->judul_laporan}}</td>
                            <td>{{$lapor->komentar}}</td>
                            <td>{{$lapor->reputation()}}</td>
                            <td>
                            <a href="/administrator/laporan/ubah/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}"><button class="btn btn-info">Ubah</button></a>
                            <a href="/administrator/laporan/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}"><button class="btn btn-default">Lihat</button></a>
                            @if(!$lapor->trashed())
                            <a href="/administrator/laporan/hapus/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}"><button class="btn btn-danger">Hapus</button></a>
                            @else
                            <a href="/administrator/laporan/aktivasi/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}"><button class="btn btn-success">Restore</button></a>
                            @endif

                            @if($lapor->status==4)
                            <a href="/administrator/laporan/pertanggung-jawaban/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}"><button class="btn btn-success">LPJ</button></a>
                            @endif
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
