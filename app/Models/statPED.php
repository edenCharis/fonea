<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statPED extends Model
{
    //

    protected $fillable = ['departement','offre','trimestre_id','secteur_id','metier_id','npa'];
    protected $table = 'stat_ped';
    public $timestamps = false;

    
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
