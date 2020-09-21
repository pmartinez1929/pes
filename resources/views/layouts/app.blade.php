<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pes2021') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,500&display=swap" rel="stylesheet">    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <section class="header-app container d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-centerjustify-content-center img_logo">
            <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{"/assets/img/logo_pes2021.png"}}" alt="PES2021"/>
            </a>
          </div>
          <div class="d-flex justify-content-end">
            @guest
              <div class="d-flex">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                <!--
                @if (Route::has('register'))
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                -->
              </div>
            @else
            <div class="d-flex align-items-center">
              <label style="margin:0 10px 0 0; border-right:1px solid white; padding:0 10px 0 0;">
                  {{ Auth::user()->name }}
              </label>
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
            @endguest
          </div>
        </section>
        <div class="container d-flex align-items-center justify-content-start menu-principal">
            <a href="{{ route("games.index") }}" class="btn_home_bar">
                {{ __('Partidos') }}
            </a>
            <a href="{{ route("stats.index") }}" class="btn_home_bar">
                {{ __('Tabla de posiciones') }}
            </a>
        </div>
        @if(session("success"))
            <div class="container mx-auto mt-5">
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b">
                  <div class="flex">
                      <p class="text-sm">{{ session("success") }}</p>
                  </div>
                </div>
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
