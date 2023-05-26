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
  console.log('huisbd');
  // Hintergrundbilder für die Diashow
  var backgroundImages = [
    'https://images.hdqwalls.com/wallpapers/call-of-duty-mobile-4k-game-2019-3a.jpg',
    'https://c4.wallpaperflare.com/wallpaper/962/231/806/airsoft-wallpaper-preview.jpg',
    'https://img.freepik.com/premium-photo/portrait-airsoft-player-professional-equipment-with-machine-gun-abandoned-ruined-building-soldier-with-weapons-war-smoke-fog_154092-2407.jpg'
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