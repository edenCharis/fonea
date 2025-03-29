<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class realisationFQ extends Model
{
    //

    protected $fillable = ['ndf','ndi','formation_qual_id','decrochage'];
    protected $table = 'realisation_f_q';
    public $timestamps = false;
    public function formationQual(){
        
        return $this->belongsTo(formationQual::class,"formation_qual_id","id");
    }

}
