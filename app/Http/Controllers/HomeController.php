<?php

namespace App\Http\Controllers;
use App\Models\Stats;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $stats = Stats::with('user')->orderBy("wins", 'DESC')->orderBy("gols_favor", 'DESC')->get();
      return view('home', compact("stats"));
    }
}
