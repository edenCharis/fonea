<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ods extends Model
{
    //
    protected $fillable = ['libelle', 'direction'];

    public $timestamps = false;
    protected $table = 'ods';

    public function direction(){
        return $this->hasMany(direction::class,"direction","code"); 
    }
}
