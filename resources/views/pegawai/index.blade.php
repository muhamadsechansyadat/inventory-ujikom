@extends('layouts.template')

@section('title','Pegawai - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!-- <div class="card-header">
            <h4>Data Surat</h4>
          </div> -->
          <div class="card-body">
            <a href="{{ url('pegawai/create') }}" class="btn btn-primary float-right">Input Pegawai</a>
            <h4 class="card-title">Data Pegawai</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Pegawai</td>
                  <td>Nama Pegawai</td>
                  <td>NIP</td>
                  <td>Alamat</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_pegawai }}</td>
                    <td>{{ $field->nip }}</td>
                    <td>{{ $field->alamat }}</td>
                    <td>
                      <a href="{{ url('pegawai/delete/'.$field->id) }}" class="btn btn-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ url('pegawai/edit/'.$field->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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