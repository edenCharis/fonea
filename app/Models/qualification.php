<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qualification extends Model
{
    //
    protected $fillable = ['libelle', 'metier_id'];

    public $timestamps = false;
    protected $table = 'qualification';

    public function metier()
    {
        return $this->belongsTo(metier::class);
    }

    public function stat_formation_qual(){

        return $this->hasMany(stat_formation_qual::class,"qualification_id","id");
        
    }

    public function detailsFQ()
    {
        return $this->hasMany(detailsFQ::class);
    }

    public function statApprentissage()
    {
        return $this->hasMany(statApprentissage::class);
    }
}
