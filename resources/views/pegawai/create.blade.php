@extends('layouts.template')

@section('title','Pegawai - Input')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Input Pegawai</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('pegawai/save') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <p><b>Nama Pegawai</b></p>
                <input type="text" name="nama_pegawai" class="form-control" required>
              </div>
              <div class="form-group">
                <p><b>NIP</b></p>
                <input type="number" name="nip" class="form-control" required>
              </div>
              <div class="form-group">
                <p><b>Alamat</b></p>
                <textarea name="alamat" id="alamat" class="form-control" required cols="30" rows="10"></textarea>
              </div>
              <div class="form-group">
                <p><b>Username</b></p>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <p><b>Password</b></p>
                <input type="text" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" value="simpan" class="btn btn-lg btn-primary" required>
              </div>
            </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection