@extends('layouts.template')

@section('title','Report Peminjaman')

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
                  <td>ID Peminjaman</td>
                  <td>Nama</td>
                  <td>Inventaris</td>
                  <td>Tgl Pinjam</td>
                  <td>Tgl Kembali</td>
                  <td>Jumlah</td>
                </tr>
              </thead>
              <tbody>
                @foreach($datapeminjaman as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_pegawai }}</td>
                    <td>{{ $field->nama_inventaris }}</td>
                    <td>{{ $field->tanggal_pinjam }}</td>
                    <td>{{ $field->tanggal_kembali }}</td>
                    <td>{{ $field->jumlah }}</td>
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