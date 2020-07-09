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
                <input type="text" name="tanggal_pengembalian" class="form-control date"
                  value="{{(@$v = old('tanggal_pengembalian'))? $v: @$data->tanggal_pengembalian}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Denda</label>
                <input type="number" name="denda" class="form-control"
                  value="{{(@$v = old('denda'))? $v: @$data->denda}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Peminjam</label>
                <select name="user_id" class="form-control">
                  <option value="" style="display: none">Pilih</option>
                  @foreach ($user as $user_row)
                  <option value="{{$user_row->id}}">{{$user_row->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Buku</label>
                <select name="book_id[]" class="form-control" multiple>
                  <option value="" style="display: none">Pilih</option>
                  @foreach ($book as $book_row)
                  <option value="{{$book_row->id}}">{{$book_row->judul}}</option>
                  @endforeach
                </select>
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
              <th>Tanggal Peminjaman</th>
              <th>Tanggal Pengembalian</th>
              <th>Total Denda</th>
              <th>Peminjam</th>
              <th>Buku</th>
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
      ajax: '{{route("admin.loan.datatable")}}',
      processing: true,
      serverSide: true,      
      columns: [
        {data: 'tanggal_peminjaman'},
        {data: 'tanggal_pengembalian'},
        {data: 'denda_format'},
        {data: 'user.name'},
        {data: 'book'},
        {data: 'action', sortable: false, searcable: false},
      ]
    });

    $('.date').daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });
  });
</script>
@endpush