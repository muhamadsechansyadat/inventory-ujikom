@extends('layouts.template')

@section('title','Jenis - Edit')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Jenis</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('jenis/update/'.$data->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <p><b>Nama Jenis</b></p>
                <input type="text" name="nama_jenis" class="form-control" required value="{{ $data->nama_jenis }}">
              </div>
              <div class="form-group">
                <p><b>Kode Jenis</b></p>
                <input type="text" name="kode_jenis" class="form-control" required readonly value="{{ $data->kode_jenis }}">
              </div>
              <div class="form-group">
                <p><b>Keterangan</b></p>
                <textarea name="keterangan" id="keterangan" class="form-control" required cols="30" rows="10">{{ $data->keterangan }}</textarea>
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