@extends('front.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-5">
      @if ($msg = Session::get('error'))
        <div class="alert alert-danger">
          <p class="p-0 m-0">{{$msg}}</p>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <form action="{{route('auth.do.login')}}" method="post">
            @csrf

            <div class="form-group">
              <label for="">Email</label>
              <input class="form-control" type="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input class="form-control" type="password" name="password" required>
            </div>

            <div class="form-group">
              <button class="btn-btn-sm btn-primary">
                Masuk
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection