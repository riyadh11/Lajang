@extends('administrator.layout.auth')

@section('content')
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
                            <button class="btn btn-info" onclick="modalEdit({{$lapor->id}})">Edit</button>
                            <a href="/administrator/laporan/perkembangan/hapus/{{$lapor->id}}"><button class="btn btn-danger">Hapus</button></a>
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
                <div class="panel-heading">Tambah Progress</div>
                <div class="panel-body">

                    <br>
                    <br>
                    <form class="form-horizontal" id="buat-progress" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/laporan/perkembangan/buat') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Progress</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="komentar" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Foto 1</label>

                            <div class="col-md-6">
                                <input id="Judul" type="file" class="form-control" name="foto[]" value="" required>
                            </div>
                        </div>

                        <input type="hidden" name="detail_laporan" value="{{$laporan->id}}">
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Progress</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="edit-progress" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/laporan/perkembangan/ubah') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Progress</label>

                            <div class="col-md-6">
                                <input id="Judul-edit" type="text" class="form-control" name="komentar" value="">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="detail_laporan-id" value="">
                        <input type="hidden" name="id-laporan" id="detail_laporan-id" value="{{$laporan->id}}">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->
<script type="text/javascript">
    function modalEdit($id) {
        $("#detail_laporan-id").val($id);
        $("#Judul-edit").val($("#Judul-"+$id).val());
        $("#myModal").modal('show');
    }
</script>
@endsection
