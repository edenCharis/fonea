<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statFormContinue extends Model
{
    //

    
    protected $fillable = ['ned','nepc','secteur_id','qualification_id','trimestre_id','competence_id'];
    protected $table = 'stat_form_continue';
    public $timestamps = false;

    public function formationContinue(){
        
        return $this->belongsTo(formationContinue::class,"formation_continue_id","id");
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

    public function competence(){
        
        return $this->belongsTo(competence::class,"competence_id","id");
    }
}
