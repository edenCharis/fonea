<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    //
    protected $fillable = ['code','libelle'];

    protected $table = 'direction';
    public $timestamps = false;

    public function user(){
      return $this->hasMany(User::class,"direction","code");
    }

    public function journalActivites(){
      return $this->hasMany(journalActivites::class,"direction","code");
    }

    public function activites(){
      return $this->hasMany(activites::class,"direction","code");
    }

}
