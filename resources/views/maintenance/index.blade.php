@extends('layouts.template')

@section('title','Maintenance - Index')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <!-- <a href="{{ url('maintenance/create') }}" class="btn btn-primary float-right">Input Inventaris</a> -->
            <h4 class="card-title">Data Maintenance</h4>
            <table class="table table-bordered table-striped table-hover" id="example">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>ID Inventaris</td>
                  <td>Nama</td>
                  <td>Jumlah Rusak</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->id }}</td>
                    <td>{{ $field->nama }}</td>
                    <td>{{ $field->jumlah_buruk }}</td>
                    <td>
                      <a href="{{ url('maintenance/edit/'.$field->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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