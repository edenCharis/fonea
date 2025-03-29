<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechniqueDeveloppementEntrepreunariat extends Model
{
    //
    protected $fillable = ['numero_identification', 'intitule','trimestre_id',"type"];

    public $timestamps = false;
    protected $table = 'tde';
  public function trimestre()
{
    return $this->belongsTo(trimestre::class);
}

public function detailsTDE(): HasMany
{
    return $this->hasMany(detailsTDE::class,"tde_id","id");
}

public function formation(): HasMany
{
    return $this->hasMany(formation::class,"tde_id","id");
}

public function financement(): HasMany
{
    return $this->hasMany(financement::class,"tde_id","id");
}

public function realisationTDE(): HasMany
{
    return $this->hasMany(realisationTDE::class,"tde_id","id");
}

public function realisationFormation(): HasMany
{
    return $this->hasMany(realisationFormation::class,"tde_id","id");
}
public function realisationFinancement(): HasMany
{
    return $this->hasMany(realisationFinancement::class,"tde_id","id");
}
}
