<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{url('assets/bootstrap/bootstrap.min.css')}}">
  <title>Perpus</title>
</head>
<body>
  @include('front.components.nav')

  <div class="container py-3">
    @yield('content')
  </div>
  
  <script src="{{url('assets/js/jquery.min.js')}}"></script>
  <script src="{{url('assets/bootstrap/bootstrap.min.js')}}"></script>
</body>
</html>