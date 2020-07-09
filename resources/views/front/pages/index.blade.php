@extends('front.app')

@section('content')
  <div class="row">
    @foreach ($book as $book_row)
      <div class="col-md-3 mt-2">
        <div class="card">
          <div class="card-body">
            <img src="{{url($book_row->gambar)}}" alt="" width="100%">
            <h5>{{$book_row->judul}}</h5>
            <br>
            <table>
              <tr>
                <td><b>Penulis</b></td>
                <td>:</td>
                <td>{{$book_row->penerbit}}</td>
              </tr>
              <tr>
                <td><b>Tahun</b></td>
                <td>:</td>
                <td>{{$book_row->tahun_terbit}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection