@extends('admin.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if ($msg = Session::get('success'))
        <div class="alert alert-success">
          <p class="p-0 m-0">{{$msg}}</p>
        </div>
      @endif
      Ini halaman dashboard
    </div>
  </div>
@endsection