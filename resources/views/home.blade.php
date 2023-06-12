@extends('layouts.app')

@section('content')
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
 
    <div class="section">
      
    </div>

 
  </div>

<script>
  // Hintergrundbilder für die Diashow
  var backgroundImages = [
    'https://images.hdqwalls.com/wallpapers/call-of-duty-mobile-4k-game-2019-3a.jpg',
    'https://images.pexels.com/photos/3706636/pexels-photo-3706636.jpeg?auto=compress&cs=tinysrgb&w=1600',
    'https://cutewallpaper.org/23/airsoft-logo-wallpaper/391520302.jpg'
  ];
  
  // Index des aktuellen Hintergrundbilds
  var currentIndex = 0;
  
  // Funktion zum Ändern des Hintergrundbilds
  function changeBackgroundImage() {
    var section = document.querySelector('.wrapper');
    section.style.backgroundImage = 'url(' + backgroundImages[currentIndex] + ')';
    currentIndex = (currentIndex + 1) % backgroundImages.length;
  }
  
  // Initialisierung der Diashow
  changeBackgroundImage();
  setInterval(changeBackgroundImage, 5000); // Hintergrundbild alle 5 Sekunden ändern
</script>
@endsection