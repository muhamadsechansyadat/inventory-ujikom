@extends('layouts.template')

@section('title','Peminjaman - Index - Pegawai')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('pegawai/peminjaman/create') }}" class="btn btn-primary float-right">Input Peminjaman</a>
            <h4 class="card-title">Data Peminjaman</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Peminjaman</td>
                  <td>Nama</td>
                  <td>Inventaris</td>
                  <td>Tgl Pinjam</td>
                  <td>Status</td>
                  <td>Jumlah</td>
                  <td>Aksi</td>
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
                    <td>@if($field->status_peminjaman == 1)
                          Belum Kembali
                        @elseif($field->status_peminjaman == 2)
                          Kembali
                        @elseif($field->status_peminjaman == 3)
                          <button class="btn btn-warning" disabled="">proses</button>
                        @elseif($field->status_peminjaman == 4)
                          <button class="btn btn-primary" disabled="">terima</button>
                        @elseif($field->status_peminjaman == 5)
                          <button class="btn btn-danger" disabled="">ditolak</button>
                        @endif  
                    </td>
                    <td>{{ $field->jumlah }}</td>
                    <td>
                      @if($field->status_peminjaman == 3)
                      <a href="{{ url('pegawai/peminjaman/edit/'.$field->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      @else
                      <p class="text-center">-</p>
                      @endif
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