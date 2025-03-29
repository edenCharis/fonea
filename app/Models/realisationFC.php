<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class realisationFC extends Model
{
    //
    protected $fillable = ['ned','nepc','formation_continue_id'];
    protected $table = 'realisation_f_c';
    public $timestamps = false;
    public function formationContinue(){
        
        return $this->belongsTo(formationContinue::class,"formation_continue_id","id");
    }
}
