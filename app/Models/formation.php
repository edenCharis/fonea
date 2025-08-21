<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formation extends Model
{
    //

    protected $fillable = ['npaf','tde_id','secteur_id','metier_id'];

    protected $table = 'details_t_d_e';
    public $timestamps = false;

    public function TechniqueDeveloppementEntrepreunariat(){

        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde_id","id");
    }

    public function secteur(){

        return $this->belongsTo(secteur::class,"secteur_id","id");
    }

     public function metier(){

        return $this->belongsTo(metier::class,"metier_id","id");
    }
    


}
