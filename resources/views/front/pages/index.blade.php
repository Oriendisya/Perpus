@extends('front.app')

@section('content')
  <div class="row">
    @for ($i = 0; $i < 10; $i++)
      <div class="col-md-3 mt-2">
        <div class="card">
          <div class="card-body">
            <img src="https://ecs7.tokopedia.net/img/cache/700/product-1/2020/1/1/352487280/352487280_ba2edbfd-de5d-4d01-8efc-d3a0e9154bfd_1080_1080.jpg" alt="" width="100%">
            <h5>Nanti kita cerita tentang hari ini</h5>
            <br>
            <table>
              <tr>
                <td><b>Penulis</b></td>
                <td>:</td>
                <td>Marchella Febritrisia</td>
              </tr>
              <tr>
                <td><b>Tahun</b></td>
                <td>:</td>
                <td>2018</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    @endfor
  </div>
@endsection