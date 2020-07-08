@extends('front.app')

@section('content')
  <div class="row">
    @for ($i = 0; $i < 10; $i++)
      <div class="col-md-3 mt-2">
        <div class="card">
          <div class="card-body">
            <div class="col-md-6">
            <div class="from group">
            <label for="">Nama Buku</label>
            <input type="text" name="judul" class="from-controll" value="">
          </div>
          <div class="from group">
            <label for="">Penerbit</label>
            <input type="text" name="penerbit" class="from-controll" value="">
          </div>
          <div class="from group">
            <label for="">Tahun Terbit</label>
            <input type="text" name="tahun" class="from-controll" value="">
          </div>
          <div class="col-md-12">
          <button class= "btn btn-primary">save</button>
          </div>
          </div>
          </div>
        </div>
      </div>
    @endfor
  </div>
@endsection