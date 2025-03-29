<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class realisationPED extends Model
{
    //

    protected $fillable = ['ped_id',	'npa',	'nbre_intra_entre',	'nbre_inter_entre'];
    protected $table = 'realisation_p_e_d';
    public $timestamps = false;
    public function ped(){
        
        return $this->belongsTo(ped::class,"ped_id","id");
    }
}
