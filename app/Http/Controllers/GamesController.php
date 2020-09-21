<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\User;
use App\Models\Stats;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    // constructor
  	public function __construct(){  	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $games = Games::with("localname", "visitname")->paginate(20);
        return view("games.index", compact("games"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // creacion de un partino
        $games = new Games;
        $title=__("Ingresar un partido");
        $textButton=__("Registrar");
        $route = route("games.store");
        $users = User::get();
        // retornamos la vista
        return view("games.create", compact("title","textButton","route","games","users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar la respuesta del usuario
        $this->validate($request,[
          "local_id" => 'required',
          "visit_id" => 'required',
          "gol_local" => 'required',
          "gol_visit" => 'required',
          "winnerpenaltys" => 'nullable',
          "winner" =>  'nullable',
          "loser" =>  'nullable',
          "draw" => 'nullable'
        ]);

        Games::create($request->only("local_id","visit_id", "gol_local", "gol_visit", "winnerpenaltys", "winner", "loser", "draw"));

        // actualizar las estadisticas
        if(isset($request->winner) && isset($request->loser)){
            $user_winner = Stats::where("user_id",$request->winner)
              ->update([
                'wins' => Stats::raw('wins + 1'),
                'gols_favor' => Stats::raw('wins + ' . ($request->winner === $request->local_id) ? $request->gol_local : $request->gol_visit),
                'gols_against' => ($request->winner === $request->local_id) ? $request->gol_visit : $request->gol_local,
              ]);
            $user_loser = Stats::where("user_id",$request->loser)
                ->update([
                  'loses' => Stats::raw('loses + 1'),
                  'gols_favor' => ($request->loser === $request->local_id) ? $request->gol_local : $request->gol_visit,
                  'gols_against' => ($request->loser === $request->local_id) ? $request->gol_visit : $request->gol_local,
              ]);
        }else{
          //empate
          $user_draw_local = Stats::where("user_id",$request->local_id)
            ->update([
              'draws' => Stats::raw('draws + 1'),
              'gols_favor' => Stats::raw('gols_favor + ' . $request->gol_local),
              'gols_against' => Stats::raw('gols_favor + ' . $request->gol_visit),
            ]);

            $user_draw_visit = Stats::where("user_id",$request->visit_id)
              ->update([
                'draws' => Stats::raw('draws + 1'),
                'gols_favor' => Stats::raw('gols_favor + ' . $request->gol_visit),
                'gols_against' => Stats::raw('gols_favor + ' . $request->gol_local),
              ]);

        }
        return redirect(route("games.index"))->with('success', __("Partido añadido".$request->winner));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $games)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(Games $games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Games $games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(Games $games)
    {
        //
    }
}
