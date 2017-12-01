@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar kelurahan</div>
                <div class="panel-body">
                    <button class="btn btn-primary" onclick="modalTambah()"> Tambah</button>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>kelurahan</th>
                            <th>Jumlah Laporan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($kelurahans as $step=>$kelurahan)
                            <tr>
                            <td>{{$step+1}}</td>
                            <td>{{$kelurahan->nama}}</td>
                            <td>{{$kelurahan->Kecamatan->nama}}</td>
                            <td>{{$kelurahan->laporan()->count()}}</td>
                            <td>
                                <button class="btn btn-info" onclick="modalEdit({{$kelurahan->id}},'{{$kelurahan->nama}}','{{$kelurahan->kodepos}}',{{$kelurahan->Kecamatan->id}})">Edit</button>
                                @if($kelurahan->trashed())
                                <a href="/administrator/daerah/kelurahan/aktivasi/{{$kelurahan->nama}}"><button class="btn btn-info">Aktivasi</button></a>
                                @else
                                <a href="/administrator/daerah/kelurahan/hapus/{{$kelurahan->nama}}"><button class="btn btn-danger">Hapus</button></a>
                                @endif
                                <a href="/administrator/daerah/kelurahan/{{$kelurahan->nama}}"><button class="btn btn-default">Lihat Laporan</button></a>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit kelurahan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-ubah-kirim" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/daerah/kelurahan/ubah') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Judul-edit" type="text" class="form-control" name="nama" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Kecamatan</label>

                            <div class="col-md-6">
                               <select name="kecamatan" id="kecamatan" class="form-control">
                                    @foreach($kecamatans as $kecamatan)
                                    <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Kode Pos</label>

                            <div class="col-md-6">
                                <input id="kodepos-edit" type="number" class="form-control" name="kodepos" value="">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="kategori-id" value="">
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
    function modalEdit($id,$nama,$kodepos,$kec) {
        $("#kategori-id").val($id);
        $("#form-ubah-kirim").attr('action','/administrator/daerah/kelurahan/ubah');
        $("#Judul-edit").val($nama);
        $("#kodepos-edit").val($kodepos);
        $("#kecamatan option[value="+$kec+"]").attr('selected', 'selected');
        $("#kecamatan").val($kec);
        $("#myModal").modal('show');
    }

    function modalTambah() {
       $(".modal-title").html("Tambah Kategori");
       $("#form-ubah-kirim").attr('action','/administrator/daerah/kelurahan/buat');
       $("#myModal").modal('show');
    }
</script>
@endsection
