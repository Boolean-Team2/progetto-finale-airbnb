<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoolB&B</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
  </head>

  <body>

    <header>

      <div class="col-lg-12" id="carousel">

        <nav>
          <div class="col-lg-6">
            <a href="#"><i class="fab fa-airbnb"></i></a>
          </div>

          <div class="col-lg-6">
            <ul>
              <li><a href="#">Accedi</a></li>
              <li><a href="#">Registrati</a></li>
              <li><a href="#">Aiuto</a></li>
              <li><a href="#">Diventa un host</a></li>
            </ul>
          </div>
        </nav>

        <div id="search">
          <h1>Cerca il to prossimo alloggio su BoolB&B</h1>
          <div class="flex">
            <input type="text" name="" value="">
            <button type="button" name="button">VAI</button>
          </div>
          <a href="#">Ricerca avanzata</a>
        </div>

      </div>

    </header>

    <main>

      <div class="container">
        <h2>Gli appartamenti in evienza</h2>
          <div class="row">

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

          </div>

          <div class="row">

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

            <div class="col-lg-4">
              <div class="box_img"></div>
              <h4>Titolo</h4>
            </div>

          </div>

      </div>


    </main>

    @include('partials.footer')

  </body>

</html>
