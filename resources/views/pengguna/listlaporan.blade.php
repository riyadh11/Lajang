@extends('penduduk.layout.auth')

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
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Waktu</th>
                            <th>Pemilik</th>
                            <th>Foto</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @foreach($laporan as $lapor)
                            <td><a href="/laporan/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}">{{$lapor->judul_laporan}}</a></td>
                            <td>{{$lapor->detail_laporan->first()->komentar}}</td>
                            <td>{{$lapor->lat.'-'.$lapor->long}}</td>
                            <td>{{$lapor->created_at}}</td>
                            <td>{{$lapor->penduduk->name}}</td>
                            <td>
                                @foreach($lapor->detail_laporan->first()->foto_laporan->all() as $step=>$foto)
                                <a href="/storage/data-laporan/{{$foto->url_gambar}}">Foto {{$step+1}}</a>
                                @endforeach
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

