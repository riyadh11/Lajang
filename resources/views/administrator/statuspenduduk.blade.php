@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Status penduduk</div>
                <div class="panel-body">
                    <button class="btn btn-primary" onclick="modalTambah()">Tambah +</button>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($Status_penduduks as $step=>$Status_penduduk)
                            <tr>
                            <td>{{$step+1}}</td>
                            <td>{{$Status_penduduk->nama}}</td>
                            <td>{{$Status_penduduk->deskripsi}}</td>
                            <td>
                                @if($Status_penduduk->trashed())
                                Tidak Aktif
                                @else
                                Aktif
                                @endif
                            </td>
                            <td><button class="btn btn-info" onclick="modalEdit({{$Status_penduduk->id}},'{{$Status_penduduk->nama}}','{{$Status_penduduk->deskripsi}}')">Edit</button>
                                @if($Status_penduduk->trashed())
                                <a href="/administrator/status/penduduk/aktivasi/{{$Status_penduduk->nama}}"><button class="btn btn-info">Aktivasi</button></a>
                                @else
                                <a href="/administrator/status/penduduk/hapus/{{$Status_penduduk->nama}}"><button class="btn btn-danger">Hapus</button></a>
                                @endif
                                 <a href="/administrator/status/penduduk/{{$Status_penduduk->nama}}"><button class="btn btn-default">Lihat Laporan</button></a>
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
        <h4 class="modal-title">Edit Status Penduduk</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-ubah-kirim" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/status/penduduk/ubah') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Judul-edit" type="text" class="form-control" name="nama" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="deskripsi-edit" type="text" class="form-control" name="deskripsi" value="">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="Status_penduduk-id" value="">
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
    function modalEdit($id,$nama,$deskripsi) {
         $("#form-ubah-kirim").attr('action','/administrator/status/penduduk/ubah');
        $("#Status_penduduk-id").val($id);
        $("#deskripsi-edit").val($deskripsi);
        $("#Judul-edit").val($nama);
        $("#myModal").modal('show');
    }

    function modalTambah() {
       $(".modal-title").html("Tambah Status penduduk");
       $("#form-ubah-kirim").attr('action','/administrator/status/penduduk/buat');
       $("#myModal").modal('show');
    }
</script>
@endsection
