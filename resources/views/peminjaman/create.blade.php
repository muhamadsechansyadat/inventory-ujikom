@extends('layouts.template')

@section('title','Peminjaman - Input')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Input Peminjaman</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('peminjaman/save') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <p><b>Nama Pegawai</b></p>
                <select name="id_pegawai" id="id_pegawai" class="form-control">
                  <option value=""></option>
                  @foreach($pegawai as $value1)
                  <option value="{{ $value1->id }}">{{ $value1->nama_pegawai }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <p><b>Nama Barang</b></p>
                <select name="id_inventaris" id="id_inventaris" class="form-control">
                  <option value=""></option>
                  @foreach($inventaris as $value)
                  <option value="{{ $value->id }}">{{ $value->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <p><b>Jumlah</b></p>
                <input type="number" class="form-control" name="jumlah" required>
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