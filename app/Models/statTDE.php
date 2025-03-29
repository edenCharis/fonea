<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statTDE extends Model
{
    //

    protected $fillable = ['tde','type','trimestre_id','secteur_id','metier_id','nipi','npf','nrb'];
    protected $table = 'stat_tde';
    public $timestamps = false;

    
    public function TechniqueDeveloppementEntrepreunariat(){
        
        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde","id");
    }
    public function trimestre(){
        
        return $this->belongsTo(trimestre::class,"trimestre_id","id");
    }
    public function secteur(){
        
        return $this->belongsTo(secteur::class,"secteur_id","id");
    }

    public function metier(){
        
        return $this->belongsTo(metier::class,"metier_id","id");
    }

}
