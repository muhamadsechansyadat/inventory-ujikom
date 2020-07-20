@extends('layouts.template')

@section('title','Report Pengembalian')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Inven</td>
                  <td>Nama</td>
                  <td>ID Peminjaman</td>
                  <td>Jml Baik</td>
                  <td>Jml Rusak</td>
                  <td>ID Pegawai</td>
                </tr>
              </thead>
              <tbody>
                @foreach($datapengembalian as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id_inventaris }}</td>
                    <td>{{ $field->nama }}</td>
                    <td>{{ $field->id_peminjaman }}</td>
                    <td>{{ $field->baik }}</td>
                    <td>{{ $field->buruk }}</td>
                    <td>{{ $field->id_pegawai}}</td>
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