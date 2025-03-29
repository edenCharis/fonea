<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class metier extends Model
{
    

    protected $fillable = ['libelle', 'secteur_id'];

    public $timestamps = false;
    protected $table = 'metier';

    public function secteur()
    {
        return $this->belongsTo(secteur::class);
    }

    public function qualification()
    {
        return $this->hasMany(qualification::class);
    }

    public function detailsTDE()
    {
        return $this->hasMany(detailsTDE::class);
    }


    public function statTDE(){

        return $this->hasMany(statTDE::class,"trimestre_id","id"); 
    }
    public function statPED(){
        
        return $this->hasMany(statTDE::class,"trimestre_id","id"); 
    }

   
}
