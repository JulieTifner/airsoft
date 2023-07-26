<!DOCTYPE html>
<html>
<head>
    {{-- <link href="{{ url('/css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

 
    </style>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="/img/logo.png">
      <span class="slogan">CIVILIAN ARMED FORCES</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto bg-dark">
        <li class="nav-item {{ request()->routeIs('events') ? 'active' : '' }}">
          <a class="nav-link text-white" href="{{ route('events') }}">Events <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Über uns</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Kontakt</a>
        </li>
        @if(auth()->check())
          @if(auth()->user()->role_id==1 || auth()->user()->role_id==2)
            <li class="nav-item {{ request()->routeIs('userlist') ? 'active' : '' }}">
              <a class="nav-link text-white" href="{{ route('userlist') }}">Benutzer</a>
            </li>
          @endif
        @endif
        <li class="nav-item">
          <a class="nav-link text-white" href="#">FAQ</a>
        </li>
        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
        @endif

        @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->firstname }}
          </a>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color:white;">
              <a class="dropdown-item" style="color:black; font-size: 16pt; padding-left: 15px;" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="width:30px;">
                  @csrf
              </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
