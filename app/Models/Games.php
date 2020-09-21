<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $fillable = ["local_id", "visit_id", "gol_local", "gol_visit", "penaltys", "draw", "winner", "loser"];

    protected static function boot(){
      parent::boot();
      // cuando se esta ejecutando un nuevo registro
      self::creating(function($table){
        // si no esta ejecutando desde el terminal
        if(!app()->runningInConsole()){
          // el id del usuario va a ser el id del usuario identificado
          //$table->user_id=auth()->id();
        }
      });
    }

    public function localname(){
      return $this->belongsTo(User::class, 'local_id');
    }

    public function visitname(){
      return $this->belongsTo(User::class, 'visit_id');
    }

}
