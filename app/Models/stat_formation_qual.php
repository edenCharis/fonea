<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stat_formation_qual extends Model
{
    //

    protected $fillable = ['ndf','ndi','formation_qual_id','decrochage','trimestre_id','secteur_nom','qualification_nom'];
    protected $table = 'stat_form_qual';
    public $timestamps = false;

    public function formationQual(){
        
        return $this->belongsTo(formationQual::class,"formation_qual_id","id");
    }

    public function trimestre(){
        
        return $this->belongsTo(trimestre::class,"trimestre_id","id");
    }
    public function secteur(){
        
        return $this->belongsTo(secteur::class,"secteur_nom","libelle");
    }

    public function qualification(){
        
        return $this->belongsTo(qualification::class,"qualification_nom","libelle");
    }
}
