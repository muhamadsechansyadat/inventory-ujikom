@extends('layouts.template')

@section('title','Level - Input')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Input Level</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('level/save') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <p><b>Nama Level</b></p>
                <input type="text" name="nama_level" class="form-control" required>
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