@extends('layouts.template')

@section('title','Peminjaman - Edit - Pegawai')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Peminjaman</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('pegawai/peminjaman/update/'.$data_edit_detail->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <p><b>ID Inventaris</b></p>
                <select name="id_inventaris" id="id_inventaris" class="form-control">
                  <option value=""></option>
                  @foreach($inventaris as $value)
                  <option value="{{ $value->id }}" @if($data_edit_detail->id_inventaris == $value->id) selected @endif>{{ $value->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <p><b>Jumlah</b></p>
                <input type="number" class="form-control" name="jumlah" required value="{{ $data_edit_detail->jumlah }}">
              </div>
                <input type="hidden" name="old_jumlah" value="{{ $data_edit_detail->jumlah }}">
                <input type="hidden" name="old_id_inventaris" value="{{ $data_edit_detail->id_inventaris }}">
              <div class="form-group">
                <input type="submit" value="update" class="btn btn-lg btn-primary" required>
              </div>
            </form>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection