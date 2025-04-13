<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detailsPED extends Model
{
    //
    protected $fillable = ['nc','npd','nip','ped_id','qualification_id','poste','nce'];

    protected $table = 'details_p_e_d';
    public $timestamps = false;
    


    public function ped(){

        return $this->belongsTo(ped::class,"ped_id","id");
    }

    

    public function qualification(){

        return $this->belongsTo(qualification::class, "qualification_id","id");
    }
}
