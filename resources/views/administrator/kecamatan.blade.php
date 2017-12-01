@extends('administrator.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Kecamatan</div>
                <div class="panel-body">
                    <button class="btn btn-primary" onclick="modalTambah()"> Tambah</button>
                    <table class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Laporan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($kecamatans as $step=>$kecamatan)
                            <tr>
                            <td>{{$step+1}}</td>
                            <td>{{$kecamatan->nama}}</td>
                            <td>{{$kecamatan->laporan()->count()}}</td>
                            <td>
                                <button class="btn btn-info" onclick="modalEdit({{$kecamatan->id}},'{{$kecamatan->nama}}')">Edit</button>
                                @if($kecamatan->trashed())
                                <a href="/administrator/daerah/kecamatan/aktivasi/{{$kecamatan->nama}}"><button class="btn btn-info">Aktivasi</button></a>
                                @else
                                <a href="/administrator/daerah/kecamatan/hapus/{{$kecamatan->nama}}"><button class="btn btn-danger">Hapus</button></a>
                                @endif
                                <a href="/administrator/daerah/kecamatan/{{$kecamatan->nama}}"><button class="btn btn-info">Lihat Kelurahan</button></a>
                                <a href="/administrator/daerah/kecamatan/{{$kecamatan->nama}}/laporan"><button class="btn btn-info">Lihat Laporan</button></a>
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
        <h4 class="modal-title">Edit Kecamatan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-ubah-kirim" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/administrator/daerah/kecamatan/ubah') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Judul-edit" type="text" class="form-control" name="nama" value="">
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
    function modalEdit($id,$nama) {
        $("#kategori-id").val($id);
        $("#form-ubah-kirim").attr('action','/administrator/daerah/kecamatan/ubah');
        $("#Judul-edit").val($nama);
        $("#myModal").modal('show');
    }

    function modalTambah() {
       $(".modal-title").html("Tambah Kategori");
       $("#form-ubah-kirim").attr('action','/administrator/daerah/kecamatan/buat');
       $("#myModal").modal('show');
    }
</script>
@endsection
