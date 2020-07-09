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
        <form action="{{$action}}" method="post">
          @csrf
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" value="{{(@$v = old('name'))? $v: @$data->name}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{(@$v = old('email'))? $v: @$data->email}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Alamant</label>
                <textarea name="address" class="form-control">{{(@$v = old('address'))? $v: @$data->address}}</textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Telephone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                  </div>
                  <input type="number" name="phone" class="form-control" value="{{(@$v = old('phone'))? $v: @$data->phone}}">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Hak Akses</label>
                <select name="role" class="form-control">
                  <option value="" style="display: none">Pilih</option>
                  <option value="admin" {{(@$data->role == 'admin')? 'selected': ''}}>Admin</option>
                  <option value="peminjam" {{(@$data->role == 'peminjam')? 'selected': ''}}>Peminjam</option>
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

  <div class="col-md-12 mt-2">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Alamat</th>
              <th>Telephone</th>
              <th>Hak Akses</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('table').DataTable({
      ajax: '{{route("admin.user.datatable")}}',
      processing: true,
      serverSide: true,      
      columns: [
        {data: 'name'},
        {data: 'email'},
        {data: 'address'},
        {data: 'phone'},
        {data: 'role'},
        {data: 'action', sortable: false, searcable: false},
      ]
    });
  });
</script>
@endpush