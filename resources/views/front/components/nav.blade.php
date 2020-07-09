<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PerpusatakaanQ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('front.index')}}">Halaman Utama</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      @if (@Auth::user()->id)
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.logout')}}">Logout</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.login')}}">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.register')}}">Daftar</a>
      </li>
      @endif
    </ul>

  </div>
</nav>