@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <img src="https://www.itl.cat/pics/b/31/317166_airsoft-wallpaper.jpg" style="width:470px;" alt="">
</div>
  <div class="wrapper">
    <div class="box">
        <h1>Lorem ipsum <br>dolor sit amet, consetetur</h1>
       <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
        sed diam nonumy eirmod tempor invidunt ut labore et dolore
        magna aliquy</p> 
    
        <div class="btn-group">
          <a href="#">Gallerie</a>
        </div>
    </div>
  </div>

  @vite('resources/js/diashow.js')

@endsection