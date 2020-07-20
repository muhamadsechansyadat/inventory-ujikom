@extends('layouts.template')

@section('title','Report Ruang')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <div class="dropdown d-inline mr-2">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ruang
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"></a>
                        @foreach($data1 as $field)
                        <a class="dropdown-item" href="{{ url('report/per/ruang/'.$field->id) }}">{{ $field->kode_ruang }}</a>
                        @endforeach
                        <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                      </div>
                    </div>
            <table class="table table-bordered table-striped table-hover mt-2" id="example" >
              <thead>
                <tr>
                  <td>NO</td>
                  <td>Nama</td>
                  <td>Jumlah</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $field)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $field->nama }}</td>
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