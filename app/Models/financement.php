<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class financement extends Model
{
    //

    protected $fillable = ['nbp','secteur_id','montant_financement','nbre_emploi_cree','tde_id'];

    protected $table = 'details_t_d_e';
    public $timestamps = false;

    public function TechniqueDeveloppementEntrepreunariat(){

        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde_id","id");
    }

      public function secteur(){

        return $this->belongsTo(secteur::class,"secteur_id","id");
    }
}
