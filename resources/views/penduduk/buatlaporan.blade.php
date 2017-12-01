@extends('penduduk.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Laporan</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/penduduk/laporan/buat') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Judul Laporan</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="judul_laporan" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kategori" class="col-md-4 control-label">Kategori</label>

                            <div class="col-md-6">
                                <select name="kategori" class="form-control">
                                    @foreach($kategoris as $kategori)
                                    <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lat" class="col-md-4 control-label">Lat</label>

                            <div class="col-md-6">
                                <input id="lat" type="text" class="form-control" name="lat" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="long" class="col-md-4 control-label">Long</label>

                            <div class="col-md-6">
                                <input id="long" type="text" class="form-control" name="long" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Gambar</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control" name="foto[]" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Gambar2</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control" name="foto[]" value="">
                            </div>
                        </div>

                        
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
@endsection
