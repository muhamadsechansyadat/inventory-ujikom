@extends('layouts.template')

@section('title','Ruang - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('ruang/create') }}" class="btn btn-primary float-right">Input Ruang</a>
            <h4 class="card-title">Data Ruang</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Ruang</td>
                  <td>Nama Ruang</td>
                  <td>Kode Ruang</td>
                  <td>Keterangan</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_ruang }}</td>
                    <td>{{ $field->kode_ruang }}</td>
                    <td>{{ $field->keterangan }}</td>
                    <td>
                      <a href="{{ url('ruang/delete/'.$field->id) }}" class="btn btn-danger mt-1" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ url('ruang/edit/'.$field->id) }}" class="btn btn-warning mt-1 mb-1"><i class="fa fa-edit"></i></a>
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