<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class realisationApprentissage extends Model
{
    
    protected $fillable = ['ndf','ndi','decrochage','apprentissage_id'];
    protected $table = 'realisation_apprentissage';
    public $timestamps = false;

    public function apprentissage(){
        
        return $this->belongsTo(apprentissage::class,"apprentissage_id","id");
    }
}
