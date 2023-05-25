<!DOCTYPE html>
<html>
<head>
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    

  <style>
    *{
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }


  </style>
</head>
<body>
  <nav class="navbar">
    <div>
      <img src="" alt="Logo">
      <span class="slogan">CIVILIAN ARMED FORCES</span>
    </div>
    <ul>
      <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
      <li><a class="nav-link" href="#">Events</a></li>
      <li><a class="nav-link" href="#">Über uns</a></li>
      <li><a class="nav-link" href="#">Kontakt</a></li>
      @if(auth()->check())
        @if(auth()->user()->role_id==1 || auth()->user()->role_id==2)
      <li><a class="nav-link" href="{{ route('userlist') }}">Benutzer</a></li>
        @endif
      @endif
      <li><a class="nav-link" href="#">FAQ</a></li>
      
      <!-- Authentication Links -->
      @guest
      @if (Route::has('login'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
      @endif
  
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>
  
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="color:black; width: 20px;">
                  <a class="dropdown-item" style="color:black;" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
    </ul>
  </nav>
  

</div>
</body>
</html>
