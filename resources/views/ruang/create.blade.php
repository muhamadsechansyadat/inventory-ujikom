@extends('layouts.template')

@section('title','Ruang - Input')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Input Ruang</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('ruang/save') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <p><b>Nama Ruang</b></p>
                <input type="text" name="nama_ruang" class="form-control" required>
              </div>
              <div class="form-group">
                <p><b>Kode Ruang</b></p>
                <input type="text" name="kode_ruang" class="form-control" required>
              </div>
              <div class="form-group">
                <p><b>Keterangan</b></p>
                <textarea name="keterangan" id="keterangan" class="form-control" required cols="30" rows="10"></textarea>
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