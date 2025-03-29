<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formationQual extends Model
{
    //
    protected $fillable = ['numero_identification', 'intitule','trimestre_id','user_id'];
    public $timestamps = false;
    protected $table = 'formation_qual';
    
  public function trimestre()
{
    return $this->belongsTo(trimestre::class);
}

public function detailsFQ(){

    return $this->hasMany(detailsFQ::class,"formation_qual_id","id");
    
}

public function stat_formation_qual(){

    return $this->hasMany(stat_formation_qual::class,"formation_qual_id","id");
    
}

public function realisationFQ(){

    return $this->hasMany(realisationFQ::class,"formation_qual_id","id");
}

}
