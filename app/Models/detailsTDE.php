<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsTDE extends Model
{
    //
    protected $fillable = ['npipi','nipi','npipaf',	'npipai','nipv','metier_id','operateur_formation','secteur_id','tde_id'];

    protected $table = 'details_t_d_e';
    public $timestamps = false;

    public function TechniqueDeveloppementEntrepreunariat(){

        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde_id","id");
    }

    public function metier(){

        return $this->belongsTo(metier::class,"secteur_id","id");
    }
    public function secteur(){

        return $this->belongsTo(secteur::class,"secteur_id","id");
    }
    


}
