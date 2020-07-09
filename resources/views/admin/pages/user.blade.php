@extends('admin.app')

@section('content')
<div class="row">
  <div class="col-md-12">

    @if (count($errors->message) > 0)
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach ($errors->message->toArray() as $msg)
            <li>{{$msg[0]}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if ($msg = Session::get('success'))
      <div class="alert alert-success">
        <p class="m-0">{{$msg}}</p>
      </div>
    @endif

    <div class="card">
      <div class="card-body">
        <form action="{{route('admin.user.store')}}" method="post">
          @csrf
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Alamant</label>
                <textarea name="address" class="form-control"></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Telephone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                  </div>
                  <input type="number" name="phone" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Hak Akses</label>
                <select name="role" class="form-control">
                  <option value="" style="display: none">Pilih</option>
                  <option value="admin">Admin</option>
                  <option value="pengunjung">Pengunjung</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
            </div>

            <div class="col-md-12 text-right">
              <div class="form-group">
                <button class="btn btn-primary">Simpan</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection