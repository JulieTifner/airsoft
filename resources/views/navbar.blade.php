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
    .navbar {
      background-color: black;
      height: 100px; 
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      color: white;
    }

    .navbar img {
      height: 40px; 
      margin-right: 10px; 
    }

    .navbar .slogan {
      font-size: 20px; 
    }

    .navbar ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .navbar ul li {
      margin-left: 10px; 
    }

    .navbar ul li a {
      padding-right: 30px;
      color: white;
      text-decoration: none;
      font-size: 13pt;
    }
    span{
        font-weight: bold;
    }
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
      <li><a href="#">Groups list</a></li>
      <li><a href="#">FAQ</a></li>
      <li><a href="#">Anmelden</a></li>
    </ul>
  </nav>
</body>
</html>
