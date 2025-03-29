<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class realisationTDE extends Model
{
    //

    protected $fillable = ['nipi','tde_id'];
    protected $table = 'realisation_t_d_e';
    public $timestamps = false;


    public function TechniqueDeveloppementEntrepreunariat()
    {

        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde_id","id");
    
    }
}
