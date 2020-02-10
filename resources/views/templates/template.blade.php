<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('body')
</body>
<footer>
  <div class="container-fluid">

    <div class="row">

      <div class="col-sm-12 col-md-2 offset-md-2">
        <p>BoolB&B</p>
        <ul>
          <li><a href="#">Opportunità di lavoro</a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Condizioni</a></li>
          <li><a href="#">Aiuto</a></li>
          <li><a href="#">Diversità e appartenenza</a></li>
          <li><a href="#">Informazioni di contatto</a></li>
        </ul>
      </div>
      <div class="col-sm-12 col-md-2">
        <p>Scopri</p>
        <ul>
          <li><a href="#">Affidabilità e sicurezza</a></li>
          <li><a href="#">Travel Credit</a></li>
          <li><a href="#">Cittadino di Airbnb</a></li>
          <li><a href="#">Viaggi di lavoro</a></li>
          <li><a href="#">Attività</a></li>
          <li><a href="#">Airbnbmag</a></li>
        </ul>
      </div>
      <div class="col-sm-12 col-md-2">
        <p>Ospita</p>
        <ul>
          <li><a href="#">Perché affittare</a></li>
          <li><a href="#">Ospitalità</a></li>
          <li><a href="#">Ospitare responsabilmente</a></li>
          <li><a href="#">Community Center</a></li>
          <li><a href="#">Offri un'esperienza</a></li>
          <li><a href="#">Open Homes</a></li>
        </ul>
      </div>
      <div class="col-sm-12 col-md-2">
        <div class="social">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <ul>
          <li><a href="#">Termini</a></li>
          <li><a href="#">Privacy</a></li>
          <li><a href="#">Mappa del sito</a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-12 col-md-2 offset-md-2 pb-3">
        <hr>
        <i class="fab fa-airbnb"></i>
        <span>© 2020 BoolB&B, Inc. All rights reserved.</span>
    </div>
  </div>
</footer>
</html>