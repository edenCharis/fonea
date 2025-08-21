<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class journalActivites extends Model
{
    //
    protected $fillable = ['libelle','trimestre_id', 'type','annee_id','direction','user_id','statut', 'date_enregistrement'];

    public $timestamps = false;
    protected $table = 'journal_activites';

    public function Direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
