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
        <form action="{{$action}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{(@$v = old('judul'))? $v: @$data->judul}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{(@$v = old('penerbit'))? $v: @$data->penerbit}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" class="form-control" value="{{(@$v = old('tahun_terbit'))? $v: @$data->tahun_terbit}}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Gambar</label>
                <br>
                <input type="file" name="image">
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
              <th>Judul</th>
              <th>Penerbit</th>
              <th>Gambar</th>
              <th>Tahun Terbit</th>
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
      ajax: '{{route("admin.book.datatable")}}',
      processing: true,
      serverSide: true,      
      columns: [
        {data: 'judul'},
        {data: 'penerbit'},
        {data: 'render'},
        {data: 'tahun_terbit'},
        {data: 'action', sortable: false, searcable: false},
      ]
    });

    $('[name=tahun_terbit]').daterangepicker({
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