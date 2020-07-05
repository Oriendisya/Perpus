@extends('front.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <form action="">

            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email">
            </div>

            <div class="form-group">
              <label for="">Alamat</label>
              <textarea name="address" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label for="">No Telephon</label>
              <input type="text" class="form-control" name="phone">
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