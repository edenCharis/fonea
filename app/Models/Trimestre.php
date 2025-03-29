<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    //
    protected $fillable = ['libelle', 'annee_id'];

    public $timestamps = false;
    protected $table = 'trimestre';
    public function annee()
{
    return $this->belongsTo(Annee::class);
}


public function formationQuals()
{
    return $this->hasMany(formationQual::class);
}

public function TechniqueDeveloppementEntrepreunariat()
{
    return $this->hasMany(TechniqueDeveloppementEntrepreunariat::class);
}



public function ped()
{
    return $this->hasMany(ped::class,"trimestre_id","id");
}

public function apprentissage()
{
    return $this->hasMany(apprentissage::class,"trimestre_id","id");
}

public function stat_formation_qual(){

    return $this->hasMany(stat_formation_qual::class,"trimestre_id","id");
    
}

public function statFormContinue(){

return $this->hasMany(statFormContinue::class,"trimestre_id","id");

}

public function statApprentissage(){

    return $this->hasMany(statApprentissage::class,"trimestre_id","id");
    
    }


    public function statTDE(){

return $this->hasMany(statTDE::class,"trimestre_id","id");

}

public function statPED(){

    return $this->hasMany(statPED::class,"trimestre_id","id");
    
}

public function journalActivites(){
    return $this->hasMany(journalActivites::class,"trimestre_id","id");
  }


    public function activites(){
        return $this->hasMany(activites::class,"trimestre_id","id");
      }
}
