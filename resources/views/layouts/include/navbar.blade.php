<!DOCTYPE html>
<html>
<head>
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    

  <style>
    /* *{
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    } */

  </style>
</head>
<body>
  <nav class="navbar">
    <div>
      <img src="https://static.wixstatic.com/media/14c019_c2f070c5…00_0.01,enc_auto/C_A_F_%20Logo%20Freigestellt.png" alt="Logo">
      <span class="slogan">CIVILIAN ARMED FORCES</span>
    </div>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Events</a></li>
      <li><a href="#">Über uns</a></li>
      <li><a href="#">Kontakt</a></li>
      @if(auth()->check())
        @if(auth()->user()->role_id==1)
      <li><a href="{{ route('userlist') }}">Benutzer</a></li>
        @endif
      @endif
      <li><a href="#">FAQ</a></li>
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
  
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" style="color:black" href="{{ route('logout') }}"
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
