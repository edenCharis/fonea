<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    //

    protected $fillable = ['libelle'];
    public $timestamps = false;
    protected $table = 'annee';

    public function trimestres()
{
    return $this->hasMany(Trimestre::class);
}
public function activites(){
    return $this->hasMany(activites::class, "annee_id", "id");
}

public function journalActivites(){
    return $this->hasMany(journalActivites::class,"trimestre_id","id");
  }
}
