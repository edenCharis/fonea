<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statApprentissage extends Model
{
    //

    protected $fillable = ['ndf','ndi','secteur_id','trimestre_id','qualification_id'];
    protected $table = 'stat_apprentissage';
    public $timestamps = false;

    public function apprentissage(){
        
        return $this->belongsTo(apprentissage::class,"apprentissage_id","id");
    }

    public function trimestre(){
        
        return $this->belongsTo(trimestre::class,"trimestre_id","id");
    }
    public function secteur(){
        
        return $this->belongsTo(secteur::class,"secteur_id","id");
    }

    public function qualification(){
        
        return $this->belongsTo(qualification::class,"qualification_id","id");
    }
}
