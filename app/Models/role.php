<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    //
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $table = 'roles';

}
