@include('navbar')


<!DOCTYPE html>
<html>
<head>
  <style>
    *{
        color: white;
    }
    .grid-container {
      display: grid;
      grid-template-columns: 1fr 1fr; 
      grid-template-rows: 1fr 1fr;
      padding-top: 0px;
      /* gap: 10px;  */
      height: 700px;
      width: 1100px;
      margin: auto;
    }

    .grid-item {
        background-color: rgba(0, 0, 0, .8);
      padding: 20px;
      font-size: 18px;
    }
    .wrapper {
    width: 100%;
    height: 1000px;
    background-image: linear-gradient(to bottom, transparent, black), url('https://cdn.wallpapersafari.com/61/5/URZrel.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    padding: 100px;
    color: white;
  }


    .wrapper .grid-container .grid-item .content{
        padding-top: 40px;
    }
    .wrapper .grid-container .grid-item span{
        font-size: 16pt;
    }

    .section{
        background-color: black;
        height: 600px;
        padding-top: 100px;
    }

    .section .content {
    margin: auto;
    background-color: rgb(49, 49, 49);
    width: 1100px;
    height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    padding-top: 10px;
  }

  .section .content h1 {
    margin: 0;
  }
</style>

</head>
<body>
    <div class="wrapper">
        <div class="grid-container">
            <div class="grid-item"><h1>Titel h1</h1>
                <div class="content">
                    <h2>Titel h2</h2>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </div>
            </div>
            <div class="grid-item">Image</div>
            <div class="grid-item">Image</div>
            <div class="grid-item"><h1>Titel h1</h1>
                <div class="content">
                    <h2>Titel h2</h2>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="content">
            <h1>Über uns</h1>
        </div>
    </div>

</body>
</html>
