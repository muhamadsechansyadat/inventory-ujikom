@extends('layouts.template')

@section('title','Peminjaman - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('peminjaman/create') }}" class="btn btn-primary float-right">Input Peminjaman</a>
            <h4 class="card-title">Data Peminjaman</h4>
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
                    <td>{{ $field->tanggal_kembali }}</td>
                    <td>{{ $field->jumlah }}</td>
                    <td>
                      @if( $field->tanggal_kembali == NULL AND $field->id_petugas == NULL )
                      <form action="{{ url('peminjaman/approve/'.$field->id) }}" method="POST">
                        {{csrf_field()}} {{method_field('PATCH')}}
                        <button class="btn btn-primary mt-1">terima</button>                     
                      </form>
                      <form action="{{ url('peminjaman/reject/'.$field->id) }}" method="POST">
                        {{csrf_field()}} {{method_field('PATCH')}}
                        <button class="btn btn-danger mt-1 mb-1">tolak</button>                     
                      </form>
                      @elseif( $field->status_peminjaman == 5)
                      <p class="text-center">-</p>
                      @elseif( $field->tanggal_kembali == NULL)
                      <a href="{{ url('peminjaman/edit/'.$field->id) }}" class="btn btn-warning mb-1 mt-1"><i class="fa fa-edit"></i></a>
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