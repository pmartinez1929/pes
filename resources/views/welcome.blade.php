<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,500&display=swap" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
          <header class="row ">
              @if (Route::has('login'))
                  <div class="w-100 d-flex justify-content-end">
                      @auth
                          <a href="{{ url('/home') }}" class="text-sm">Home</a>
                      @else
                          <a href="{{ route('login') }}" class="text-sm">Login</a>
                          <!--
                          @if (Route::has('register'))
                              <a href="{{ route('register') }}" class="text-sm">Register</a>
                          @endif
                          -->
                      @endif
                  </div>
              @endif
            </header>
            <div class="container">
              <div class="row">
                <div class="w-100 d-flex aling-items-center justify-content-center img_logo"><img src="{{"/assets/img/logo_pes2021.png"}}" alt="PES2021"/></div>
              </div>
              <div class="container d-flex align-items-center justify-content-center menu-principal">
                  <a href="{{ route("games.index") }}" class="btn_home_bar">
                      {{ __('Partidos') }}
                  </a>
                  <a href="{{ route("stats.index") }}" class="btn_home_bar">
                      {{ __('Tabla de posiciones') }}
                  </a>
              </div>
              <div class="d-flex aling-items-center justify-content-center table-positions">
                  @foreach($stats as  $key=>$stat)

                    <div class="competitor">
                      <div class="number">{{ $key + 1 }}</div>
                      <div class="name">{{$stat->user->name}}</div>
                    </div>
                  @endforeach
              </div>
            </div>
        </div>
    </body>
</html>
