<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsApprentissage extends Model
{
    //

    protected $fillable = ['apprentissage_id', 'secteur_id','qualification_id','operateur_formation','ndai','ndaf'];
    public $timestamps = false;

    protected $table = 'details_apprentissage';
    public function apprentissage(){
        
        return $this->belongsTo(apprentissage::class,"apprentissage_id","id");
    }
    public function secteur(){

        return $this->belongsTo(secteur::class);
    }
    public function qualification(){

        return $this->belongsTo(metier::class);
    }

}
