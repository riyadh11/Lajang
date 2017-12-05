@extends('penduduk.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profil</div>
                <div class="panel-body">

                    <img src="/storage/data-penduduk/{{$penduduk->url_foto}}" class="img-thumbnail" alt="Profil">
                    <br>
                    <br>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/penduduk/profil/ubah') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="nama" value="{{$penduduk->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control" name="email" value="{{$penduduk->email}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">NIK</label>

                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control" name="nik" value="{{$penduduk->nik}}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control" name="foto" >
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
