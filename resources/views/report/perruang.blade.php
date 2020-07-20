@extends('layouts.template')

@section('title','Report Ruang')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <table class="table table-bordered table-striped table-hover" id="example" >
              <thead>
                <tr>
                  <td>NO</td>
                  <td>Nama</td>
                  <td>Jumlah</td>
                </tr>
              </thead>
              <tbody>
                @foreach($data1 as $field)
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