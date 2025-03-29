<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class secteur extends Model
{
    //
    protected $fillable = ['libelle'];

    public $timestamps = false;
    protected $table = 'secteur';

    public function metiers()
    {
       return $this->hasMany(Metier::class);
    }

    public function ped()
    {
       return $this->hasMany(ped::class);
    }
    public function detailsFQs()
    {
        return $this->hasMany(detailsFQ::class);
    }
    public function formationContinue()
    {
        return $this->hasMany(formationContinue::class);
    }

    public function detailsTDE()
    {
        return $this->hasMany(TechniqueDeveloppementEntrepreunariat::class);
    }
    public function stat_formation_qual(){

        return $this->hasMany(stat_formation_qual::class,"secteur_id","id");
        
    }

    public function statFormContinue(){

        return $this->hasMany(statFormContinue::class,"secteur_id","id");
        
    }

    public function statApprentissage(){

        return $this->hasMany(statApprentissage::class,"secteur_id","id");
        
    }

    public function statTDE(){

        return $this->hasMany(statTDE::class,"secteur_id","id");
        
    }
    public function statPED(){

        return $this->hasMany(statTDE::class,"secteur_id","id");
        
    }

}
