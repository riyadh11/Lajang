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
                            <th>Lokasi</th>
                            <th>Kategori</th>
                            <th>Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $lapor)
                            <tr>
                            <td>{{$lapor->judul_laporan}}</td>
                            <td>{{$lapor->alamat}}</td>
                            <td>{{$lapor->Kategori->nama}}</td>
                            <td><a href="/penduduk/laporan/ubah/{{$lapor->judul_laporan.'+'.$lapor->lat.'+'.$lapor->long}}">Edit</a></td>
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
