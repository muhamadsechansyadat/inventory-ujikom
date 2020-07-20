@extends('layouts.template')

@section('title','Inventaris - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('inven/create') }}" class="btn btn-primary float-right">Input Inventaris</a>
            <h4 class="card-title">Data Inventaris</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Inventaris</td>
                  <td>Nama</td>
                  <td>Jumlah</td>
                  <td>ID Jenis</td>
                  <td>Kode Ruang</td>
                  <td>Kode Inven</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama }}</td>
                    <td>{{ $field->jumlah }}</td>
                    <td>{{ $field->id_jenis }}</td>
                    <td>{{ $field->kode_ruang }}
                    </td>
                    <td>{{ $field->kode_inventaris }}</td>
                    <td>
                      <a href="{{ url('inven/delete/'.$field->id) }}" class="btn btn-danger" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ url('inven/edit/'.$field->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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