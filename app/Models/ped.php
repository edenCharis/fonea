<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ped extends Model
{
    //

    protected $fillable = ['numero_identification','offre','departement',	'entreprise','secteur_id','trimestre_id','user_id'];


    public $timestamps = false;
    protected $table = 'ped';
  

    public function trimestre()
{
    return $this->belongsTo(trimestre::class);
}

public function secteur()
{
    return $this->belongsTo(secteur::class);
}

public function detailsPED(){

    return $this->hasMany(detailsPED::class,"ped_id","id");
    
}

public function realisationPED(){

    return $this->hasMany(realisationPED::class,"ped_id","id");
    
}


}
