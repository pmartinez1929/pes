<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "wins", "loses", "draws","gols_favor","gols_against"];

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

    public function user(){
      return $this->belongsTo(User::class);
    }
}
