<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formationContinue extends Model
{
    //

    protected $fillable = ['numero_identification', 'intitule','ned','secteur_id','trimestre_id', 'user_id'];

    public $timestamps = false;
    protected $table = 'formation_continue';
  public function trimestre()
   {
        return $this->belongsTo(trimestre::class);
   }

    public function user()
   {
        return $this->belongsTo(user::class);
   }

   public function secteur()
   {
        return $this->belongsTo(secteur::class);
   }


    public function detailsFC(){

     return $this->hasMany(detailsFC::class,"formation_continue_id","id");
 }
   public function realisationFC(){

     return $this->hasMany(realisationFC::class,"formation_continue_id","id");
 }


 protected static function boot()
{
    parent::boot();
    
    static::deleting(function ($record) {
        // Automatically delete related journal entries
        JournalActivites::where('libelle', $record->libelle)->delete();
    });
}
}
