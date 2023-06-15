<!DOCTYPE html>
<html>
<head>
    {{-- <link href="{{ url('/css/app.css') }}" rel="stylesheet"> --}}
    
</head>
<style>
    #logout-form{
      color:red;
    }
</style>
<body>
  <nav class="navbar">
    <div>
      <img src="" alt="Logo">
      <a href="{{ route('home') }}" style="color: white; text-decoration: none;">
        <span class="slogan">CIVILIAN ARMED FORCES</span>
      </a>
    </div>
       
    <ul>
      <li><a class="nav-link {{ request()->routeIs('events') ? ' current' : '' }}" href="{{ route('events') }}">Events</a></li>
      <li><a class="nav-link" href="#">Über uns</a></li>
      <li><a class="nav-link" href="#">Kontakt</a></li>
      @if(auth()->check())
        @if(auth()->user()->role_id==1 || auth()->user()->role_id==2)
      <li><a class="nav-link {{ request()->routeIs('userlist') ? ' current' : '' }}"  href="{{ route('userlist') }}">Benutzer</a></li>
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
  </nav>
  

</div>
</body>
</html>
