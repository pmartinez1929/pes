<?php
use App\Http\Controllers\GamesController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;
use App\Models\Stats;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $stats = Stats::with('user')->orderBy("wins", 'DESC')->orderBy("gols_favor", 'DESC')->get();
    return view('welcome')->with('stats', $stats);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('games', GamesController::class);
Route::resource('stats', StatsController::class);
