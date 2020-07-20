@extends('layouts.template')

@section('title','Pengembalian - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            {{-- <a href="{{ url('Pengembalian/create') }}" class="btn btn-primary float-right">Input Pengembalian</a> --}}
            <h4 class="card-title">Data Pengembalian</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID</td>
                  <td>Nama Inventaris</td>
                  <td>Tgl Kembali</td>
                  <td>Jumlah</td>
                  <td>Status Peminjaman</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($datapeminjaman as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama_inventaris }}</td>
                    <td>{{ $field->tanggal_kembali }}</td>
                    <td>{{ $field->jumlah }}</td>
                    <td>@if( $field->status_peminjaman == 1 || $field->status_peminjaman == 4 )
                          Belum Kembali
                        @elseif ( $field->status_peminjaman == 2 )
                          Kembali
                        @elseif ( $field->status_peminjaman == 5 )
                          Permintaan Di Tolak
                        @endif    
                    </td>  
                    <td>
                        @if( $field->tanggal_kembali == NULL AND $field->id_petugas == NULL )
                          <p class="text-center">-</p>
                        @elseif( $field->status_peminjaman == 5)
                          <p class="text-center">-</p>
                        @elseif( $field->tanggal_kembali == NULL )
                          <a href="{{ url('pengembalian/create/'.$field->id) }}" class="btn btn-success mt-1"><i class="fa fa-paper-plane"></i></a>
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