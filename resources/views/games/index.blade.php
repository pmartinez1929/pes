@extends("layouts.app")
@section("content")
  <div class="container info-partidos">
    <div class="w-100 d-flex justify-content-between align-items-center header-partidos">
      <h2 class="d-flex w-100">{{__("Partidos")}}</h2>
      @auth
      <a href="{{ route("games.create") }}" class="btn-styles back-green">
        {{ __("+ Nuevo partido") }}
      </a>
      @endauth
    </div>

    <div class="d-flex  games-table">
      @forelse($games as $game)
        <div class="w-100 date">{{date_format($game->created_at, "d/m/Y")}}</div>
        <div class="w-100 aling-items-center justify-content-center game">
          <div class="name">{{$game->localname->name}}</div>
          <div class="score  winner"><span>{{ $game->gol_local}}</span></div>
          <div class="separator">-</div>
          <div class="score loser"><span>{{ $game->gol_visit}}</span></div>
          <div class="name">{{$game->visitname->name}}</div>
        </div>
      @empty
          <div class="w-100 date">{{ __("No hay partidos registrados") }}</div>
        @endforelse
    </div>
    @if($games->count())
      <div class="w-100 pagination-bar">
        {{ $games -> links("pagination::bootstrap-4")}}
      </div>
    @endif
  </div>
@endsection
