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
                <label for="">Tanggal Pengembalian</label>
                <input type="text" name="tanggal_pengembalian" class="form-control" value="{{(@$v = old('tanggal_pengembalian'))? $v: @$data->tanggal_pengembalian}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Denda per hari</label>
                <input type="text" name="denda" class="form-control" value="{{(@$v = old('denda'))? $v: @$data->denda}}">
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
