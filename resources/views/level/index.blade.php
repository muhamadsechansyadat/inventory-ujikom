@extends('layouts.template')

@section('title','Level - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('level/create') }}" class="btn btn-primary float-right">Input Level</a>
            <h4 class="card-title">Data Level</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Level</td>
                  <td>Level</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_level }}</td>
                    <td>
                      <a href="{{ url('level/delete/'.$field->id) }}" class="btn btn-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ url('level/edit/'.$field->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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
@endsection