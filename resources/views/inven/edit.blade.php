@extends('layouts.template')

@section('title','Inventaris - Edit')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Inventaris</h4>
          </div>
          <div class="card-body">
            <form action="{{ url('inven/update/'.$data->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                <p><b>Nama</b></p>
                <input type="text" name="nama" class="form-control" required value="{{ $data->nama }}">
              </div>
              <div class="form-group">
                <p><b>Keterangan</b></p>
                <textarea name="keterangan" id="keterangan" class="form-control" required cols="30" rows="10">{{ $data->keterangan }}</textarea>
              </div>
              <div class="form-group">
                <p><b>Jumlah</b></p>
                <input type="number" name="jumlah" class="form-control" required value="{{ $data->jumlah }}">
              </div>
              <div class="form-group">
                <p><b>ID Jenis</b></p>
                <select name="id_jenis" id="id_jenis" class="form-control">
                  <option value=""></option>
                  @foreach($jenis as $field)
                    <option value="{{ $field->id }}" @if($data->id_jenis == $field->id) selected @endif>{{ $field->id }}/{{ $field->nama_jenis }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <p><b>ID Ruang</b></p>
                <select name="id_ruang" id="id_ruang" class="form-control">
                  <option value=""></option>
                  @foreach($ruang as $field)
                    <option value="{{ $field->id }}" @if($data->id_ruang == $field->id) selected @endif>{{ $field->id }}/{{ $field->kode_ruang }}</option>
                  @endforeach
                </select>
              </div>
              {{-- <input type="hidden" name="id_petugas" class="form-control" readonly required value="{{Auth::user()->id}}"> --}}
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