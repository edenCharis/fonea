<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formationContinue extends Model
{
    //

    protected $fillable = ['numero_identification', 'intitule','ned','nepc','secteur_id','trimestre_id', 'user_id'];

    public $timestamps = false;
    protected $table = 'formation_continue';
  public function trimestre()
   {
        return $this->belongsTo(trimestre::class);
   }

   public function secteur()
   {
        return $this->belongsTo(secteur::class);
   }

   public function realisationFC(){

     return $this->hasMany(realisationFC::class,"formation_continue_id","id");
 }
}
