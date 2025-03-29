<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formation extends Model
{
    //

    protected $fillable = ['npaf','tde_id'];

    protected $table = 'details_t_d_e';
    public $timestamps = false;

    public function TechniqueDeveloppementEntrepreunariat(){

        return $this->belongsTo(TechniqueDeveloppementEntrepreunariat::class,"tde_id","id");
    }

    
    


}
