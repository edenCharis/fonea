<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsFQ extends Model
{
    //

    protected $fillable = ['ndaf','ndai','formation_qual_id','secteur_id','qualification_id'];

    protected $table = 'details_f_q';
    public $timestamps = false;
    


    public function formationQual(){

        return $this->belongsTo(formationQual::class,"formation_qual_id","id");
    }

    public function secteur(){

        return $this->belongsTo(secteur::class);
    }

    public function qualification(){

        return $this->belongsTo(qualification::class);
    }
}
