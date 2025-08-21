<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class activites extends Model
{
    //

    protected $fillable = ['libelle', 'taux', 'mtb','direction_id','annee_id','user_id','statut'];

    public $timestamps = false;
    protected $table = 'activites';

    public function annee()
    {
        return $this->belongsTo(annee::class);
    }

    public function Direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
