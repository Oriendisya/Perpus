<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>PerpustakaanQ - Admin</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{url('assets/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/datatable/datatables.min.css')}}">

  <!-- Favicons -->
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="{{url('assets/css/dashboard.css')}}" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{route('auth.logout')}}">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard.index')}}">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.user.index')}}">
                User
              </a>
            </li>
          </ul>

          {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6> --}}
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-3">
        @yield('content')
      </main>
    </div>
  </div>
  <script src="{{url('assets/js/jquery.min.js')}}"></script>
  <script src="{{url('assets/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{url('assets/datatable/datatables.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      let menu = $('.nav li a');

      $.each(menu, function (index, value) { 
        if (menu.eq(index).attr('href') == '{{Request::url()}}') {
          menu.eq(index).addClass('active');
        }
      });
    });
  </script>

  @stack('script')

</html>