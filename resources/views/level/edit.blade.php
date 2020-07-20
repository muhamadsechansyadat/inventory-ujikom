@extends('layouts.template')

@section('title','Level - Edit')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Level</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('level/update/'.$data->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <p><b>Nama Level</b></p>
                <input type="text" name="nama_level" class="form-control" value="{{ $data->nama_level }}" required>
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