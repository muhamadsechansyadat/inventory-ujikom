@extends('layouts.template')

@section('title','Pengembalian - Input - Operator')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Input Pengembalian</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('operator/pengembalian/save/'.$data_create_detail->id) }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <p><b>Nama Barang</b></p>
                <input type="text" class="form-control" name="id_inventaris" required value="{{ $data_create_detail->id_inventaris }}" readonly="">
              </div>
              <div class="form-group">
                <p><b>ID Peminjaman</b></p>
                <input type="text" class="form-control" name="id_peminjaman" required value="{{ $data_create_detail->id_peminjaman }}" readonly="">
              </div>
              <div class="form-group">
                <p><b>Jumlah</b></p>
                <input type="text" class="form-control" name="jumlah" required value="{{ $data_create_detail->jumlah }}" readonly="">
              </div>
              <div class="form-group">
                <p><b>Jumlah Baik</b></p>
                <input type="number" class="form-control" name="baik" required="">
              </div>
              <div class="form-group">
                <p><b>Jumlah Rusak</b></p>
                <input type="number" class="form-control" name="buruk" required="">
              </div>
              <div class="form-group">
                <input type="submit" value="simpan" class="btn btn-lg btn-primary" required>
              </div>
            </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection