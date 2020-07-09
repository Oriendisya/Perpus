@extends('front.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">

    @if (count($errors->message) > 0)
    <div class="alert alert-danger">
      <ul class="m-0">
        @foreach ($errors->message->toArray() as $msg)
        <li>{{$msg[0]}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <div class="card">
      <div class="card-body">
        <form action="{{route('auth.do.register')}}" method="post">
          @csrf

          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="name" value="{{@old('name')}}">
          </div>

          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" value="{{@old('email')}}">
          </div>

          <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="address" class="form-control">{{@old('address')}}</textarea>
          </div>

          <div class="form-group">
            <label for="">Telephone</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+62</span>
              </div>
              <input type="number" name="phone" class="form-control" value="{{@old('phone')}}">
            </div>
          </div>

          <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
          </div>

          <div class="form-group">
            <button class="btn-btn-sm btn-primary">
              Daftar
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection