<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apprentissage extends Model
{
    //

    protected $fillable = ['numero_identification', 'intitule','trimestre_id','user_id'];

    public $timestamps = false;
    protected $table = 'apprentissage';

    public function trimestre ()
    {
        
        
        return $this->belongsTo(trimestre::class,);
    }

     public function user ()
    {
        
        
        return $this->belongsTo(user::class,);
    }

    public function realisationApprentissage(){
        
          return $this->hasMany(realisationApprentissage::class,"apprentissage_id","id");
    }
    
public function detailsApprentissage(){

    return $this->hasMany(detailsApprentissage::class,"apprentissage_id","id");
    
}


protected static function boot()
{
    parent::boot();
    
    static::deleting(function ($record) {
        // Automatically delete related journal entries
        JournalActivites::where('libelle', $record->libelle)->delete();
    });
}
}
