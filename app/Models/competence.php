<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class competence extends Model
{
    //

    protected $fillable = ['libelle'];

    protected $table = 'competence';
    public $timestamps = false;

    public function detailsFC()
    {
        return $this->hasMany(detailsFC::class);
    }

    public function statFormContinue(){

        return $this->hasMany(statFormContinue::class,"competence_id","id");
        
    }
}
