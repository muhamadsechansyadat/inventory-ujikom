@extends('layouts.template')

@section('title','Maintenance - Fix Barang')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Fix Barang Maintenance</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('maintenance/update/'.$data->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <p><b>Nama</b></p>
                <input type="text" name="nama" class="form-control" required readonly value="{{ $data->nama }}">
              </div>
              <div class="form-group">
                <p><b>Jumlah Yang Di Perbaiki</b></p>
                <input type="text" name="jumlah_buruk" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" value="update" class="btn btn-lg btn-primary" required>
              </div>
            </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection