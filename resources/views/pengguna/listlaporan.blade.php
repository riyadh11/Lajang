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
                            @if($laporan->count()!=0)
                            @foreach($laporan as $lapor)
                        <tr>
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
                            @else
                            <td></td>
                            <td></td>
                            <td>Tidak ada laporan!</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                        </tbody>
                      </table>

                        <div class="form-group">
                            <label for="cari" class="col-md-4 control-label">Cari Laporan</label>
                            <div class="col-md-6">
                                <input id="cari" type="text" class="form-control" name="param" value="">
                                <button class="btn btn-info" onclick="cari()">Cari</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function cari() {
        Input=$("#cari").val();
        if(Input!="" && Input!=" "){
            window.location.href = "/laporan/cari/"+Input+"/page/1";    
        }
    }
</script>

@endsection

