<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsFC extends Model
{
    //
    protected $fillable = ['formation_continue_id','nbrEmploye','competence_id','entreprise','poste'];

    protected $table = 'details_f_c';
    public $timestamps = false;

    public function formation_continue(){

        return $this->belongsTo(formationContinue::class,"formation_continue_id","id");
    }

    public function competence(){

        return $this->belongsTo(competence::class);
    }
}
