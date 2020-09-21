@extends("layouts.app")
@section("content")
  <div class="container">
    <h1 class="d-flex w-100">{{__("Tabla de Posiciones")}}</h1>
    <div class="row col-12 container-table">
      @foreach($stats as $stat)
        <div class="w-100 d-flex user-stadistics justify-content-between">
          <div class="d-flex align-items-center justify-content-start name-container">
            <h4>{{ $stat->user->name }}</h4>
          </div>
          <div class="d-flex align-items-center justify-content-center table-stadistics">
            <div class="stadistics">
              <label>{{__("Partidos")}}</label>
              <span>{{ $stat->wins + $stat->draws + $stat->loses }}</span>
            </div>
            <div class="stadistics">
              <label>{{__("Victorias")}}</label>
              <span>{{ $stat->wins }}</span>
            </div>
            <div class="stadistics">
              <label>{{__("Empates")}}</label>
              <span>{{ $stat->draws }}</span>
            </div>
            <div class="stadistics">
              <label>{{__("Derrotas")}}</label>
              <span>{{ $stat->loses }}</span>
            </div>
            <div class="stadistics">
              <label>{{__("GF")}}</label>
              <span>{{ $stat->gols_favor }}</span>
            </div>
            <div class="stadistics">
              <label>{{__("GC")}}</label>
              <span>{{ $stat->gols_against }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  </div>
@endsection
