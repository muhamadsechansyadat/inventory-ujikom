@extends('layouts.template')

@section('title','Jenis - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!-- <div class="card-header">
            <h4>Data Surat</h4>
          </div> -->
          <div class="card-body">
            <a href="{{ url('jenis/create') }}" class="btn btn-primary float-right">Input Jenis</a>
            <h4 class="card-title">Data Jenis</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Jenis</td>
                  <td>Nama Jenis</td>
                  <td>Kode Jenis</td>
                  <td>Keterangan</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_jenis }}</td>
                    <td>{{ $field->kode_jenis }}</td>
                    <td>{{ $field->keterangan }}</td>
                    <td>
                      <a href="{{ url('jenis/delete/'.$field->id) }}" class="btn btn-danger mt-1" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ url('jenis/edit/'.$field->id) }}" class="btn btn-warning mt-1 mb-1"><i class="fa fa-edit"></i></a>
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