  var backgroundImages = [
    'https://images.hdqwalls.com/wallpapers/call-of-duty-mobile-4k-game-2019-3a.jpg',
    'https://images.pexels.com/photos/3706636/pexels-photo-3706636.jpeg?auto=compress&cs=tinysrgb&w=1600',
    'https://cutewallpaper.org/23/airsoft-logo-wallpaper/391520302.jpg'
  ];

  var currentIndex = 0;

  function changeBackgroundImage() {
    var section = document.querySelector('.wrapper');
    section.style.backgroundImage = 'url(' + backgroundImages[currentIndex] + ')';
    currentIndex = (currentIndex + 1) % backgroundImages.length;
  }

  function startSlideshow() {
    if (window.innerWidth > 800) {
      changeBackgroundImage();
      setInterval(changeBackgroundImage, 5000);
    }
  }

  // Eventlistener hinzufügen, um die Diashow beim Laden der Seite zu starten
  window.addEventListener('load', startSlideshow);
