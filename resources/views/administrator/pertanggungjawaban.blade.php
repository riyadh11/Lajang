@extends('administrator.layout.auth')

@section('content')
@if($lpj)
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$laporan->judul_laporan}}</div>
                <div class="panel-body">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        @foreach($laporan->detail_laporan->first()->foto_laporan->all() as $step=>$foto)
                        @if($step==0)
                        <li data-target="#myCarousel" data-slide-to="{{$step}}" class="active"></li>
                        @else
                        <li data-target="#myCarousel" data-slide-to="{{$step}}"></li>
                        @endif
                        @endforeach
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                        
                        @foreach($laporan->detail_laporan->first()->foto_laporan->all() as $step=>$foto)
                                @if($step==0)
                                <div class="item active">
                                  <img src="/storage/data-laporan/{{$foto->url_gambar}}" alt="{{$laporan->judul_laporan}}">
                                </div>
                                @else
                                <div class="item">
                                  <img src="/storage/data-laporan/{{$foto->url_gambar}}" alt="{{$laporan->judul_laporan}}">
                                </div>
                                @endif
                        @endforeach
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>

                    <br>
                    <br>

                    <div class="form-horizontal">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Judul Laporan</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="judul_laporan" value="{{$laporan->judul_laporan}}" readonly>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Pelapor</label>

                            <div class="col-md-6">
                                <input id="Pelapor" type="text" class="form-control" name="lat" value="{{$laporan->penduduk->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Lokasi</label>

                            <div class="col-md-6">
                                <input id="Pelapor" type="text" class="form-control" name="lat" value="{{$laporan->alamat}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Lat</label>

                            <div class="col-md-6">
                                <input id="lat" type="text" class="form-control" name="lat" value="{{$laporan->lat}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Long</label>

                            <div class="col-md-6">
                                <input id="long" type="text" class="form-control" name="long" value="{{$laporan->long}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{$laporan->detail_laporan->first()->komentar}}" readonly>
                            </div>
                        </div>                        
                    </div>
                    <br>
                    <br>
                </div>
            </div>

            <!--- Progress -->
            <div class="panel panel-default">
                <div class="panel-heading">Progress</div>
                <div class="panel-body">
                    <br>
                    <br>
                    <div class="form-horizontal">
                        @if(count($laporan->detail_laporan)>1)
                        @foreach($laporan->detail_laporan->where('delete',0) as $step=>$lapor)
                        @if($step!=0)
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">{{\App\Penduduk::find($lapor->penduduk)->name}}</label>

                            <div class="col-md-6">
                                <input id="Judul-{{$lapor->id}}" type="text" class="form-control" name="judul_laporan" value="{{$lapor->komentar}}" readonly>
                            </div>
                        </div>
                        <br>
                        @endif
                        @endforeach
                        @else
                        <center>Belum ada progress!</center>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <!-- Tambah Progress -->
            <div class="panel panel-default">
                <div class="panel-heading">LPJ</div>
                <div class="panel-body">

                    <br>
                    <br>
                    <form class="form-horizontal" id="buat-progress" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/laporan/pertanggung-jawaban/buat') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Keterangan</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="keterangan" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Kendala</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="kendala" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Solusi</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="solusi" value="">
                            </div>
                        </div>

                        <br>
                        <div>
                            <center><button class="btn btn-default" role="button" type="button" onclick="tambah()">Tambah Biaya</button></center>
                        </div>
                        <br>
                        <!-- Biaya -->
                        <div id="biaya" >
                        <div id="appending">                        <div class="form-group" >
                            <label for="email" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="nama[]" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="deskripsi[]" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Unit</label>

                            <div class="col-md-6">
                                <input id="Judul" type="number" min="0" class="form-control" name="unit[]" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Harga</label>

                            <div class="col-md-6">
                                <input id="Judul" type="number" min="0" class="form-control" name="harga[]" value="">
                            </div>
                        </div>
                    </div>
                        </div>
                        <input type="hidden" name="laporan" value="{{$laporan->id}}">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    
    function tambah() {
        var html=$("#appending").html();
        $("#biaya").append(html);
    }
</script>
@else
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$laporan->judul_laporan}}</div>
                <div class="panel-body">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        @foreach($laporan->detail_laporan->first()->foto_laporan->all() as $step=>$foto)
                        @if($step==0)
                        <li data-target="#myCarousel" data-slide-to="{{$step}}" class="active"></li>
                        @else
                        <li data-target="#myCarousel" data-slide-to="{{$step}}"></li>
                        @endif
                        @endforeach
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                        
                        @foreach($laporan->detail_laporan->first()->foto_laporan->all() as $step=>$foto)
                                @if($step==0)
                                <div class="item active">
                                  <img src="/storage/data-laporan/{{$foto->url_gambar}}" alt="{{$laporan->judul_laporan}}">
                                </div>
                                @else
                                <div class="item">
                                  <img src="/storage/data-laporan/{{$foto->url_gambar}}" alt="{{$laporan->judul_laporan}}">
                                </div>
                                @endif
                        @endforeach
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>

                    <br>
                    <br>

                    <div class="form-horizontal">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Judul Laporan</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="judul_laporan" value="{{$laporan->judul_laporan}}" readonly>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Pelapor</label>

                            <div class="col-md-6">
                                <input id="Pelapor" type="text" class="form-control" name="lat" value="{{$laporan->penduduk->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Lokasi</label>

                            <div class="col-md-6">
                                <input id="Pelapor" type="text" class="form-control" name="lat" value="{{$laporan->alamat}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Lat</label>

                            <div class="col-md-6">
                                <input id="lat" type="text" class="form-control" name="lat" value="{{$laporan->lat}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Long</label>

                            <div class="col-md-6">
                                <input id="long" type="text" class="form-control" name="long" value="{{$laporan->long}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{$laporan->detail_laporan->first()->komentar}}" readonly>
                            </div>
                        </div>                        
                    </div>
                    <br>
                    <br>
                </div>
            </div>

            <!--- Progress -->
            <div class="panel panel-default">
                <div class="panel-heading">Progress</div>
                <div class="panel-body">
                    <br>
                    <br>
                    <div class="form-horizontal">
                        @if(count($laporan->detail_laporan)>1)
                        @foreach($laporan->detail_laporan->where('delete',0) as $step=>$lapor)
                        @if($step!=0)
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">{{\App\Penduduk::find($lapor->penduduk)->name}}</label>

                            <div class="col-md-6">
                                <input id="Judul-{{$lapor->id}}" type="text" class="form-control" name="judul_laporan" value="{{$lapor->komentar}}" readonly>
                            </div>
                        </div>
                        <br>
                        @endif
                        @endforeach
                        @else
                        <center>Belum ada progress!</center>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <!--- LPJ -->
            <div class="panel panel-default">
                <div class="panel-heading">Laporan Pertanggung Jawaban</div>
                <div class="panel-body">
                    <br>
                    <br>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <textarea readonly="true" class="form-control">{{$laporan->PertanggungJawaban->keterangan}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Kendala</label>
                            <div class="col-md-6">
                                <textarea readonly="true" class="form-control">{{$laporan->PertanggungJawaban->kendala}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Solusi</label>
                            <div class="col-md-6">
                                <textarea readonly="true" class="form-control">{{$laporan->PertanggungJawaban->solusi}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Administrator</label>
                            <div class="col-md-6">
                                <input class="form-control" name="admin" value="{{$laporan->PertanggungJawaban->Administrator->name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <h3>Biaya</h3>
                     <table class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Unit</th>
                            <th>Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan->PertanggungJawaban->Biaya as $step=>$biaya)
                            <tr>
                            <td>{{$step+1}}</td>
                            <td>{{$biaya->nama}}</td>
                            <td>{{$biaya->deskripsi}}</td>
                            <td>{{$biaya->unit}}</td>
                            <td>{{$biaya->harga}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@endsection
