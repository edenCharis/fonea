<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
use HasRoles;


    protected $fillable = [
      'id',
        'name',
        'lastName',
        'email',
        'password',
        'role',
        'direction'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function direction(){

        return $this->belongsTo(Direction::class,"direction", "code");

    }

     public function journalActivites(){
        return $this->hasMany(journalActivites::class,"user_id","id");
      }

       public function TechniqueDeveloppementEntrepreunariat(){
        return $this->hasMany(TechniqueDeveloppementEntrepreunariat::class,"user_id","id");
      }

      public function financement(){
        return $this->hasMany(financement::class,"user_id","id");
      }

       public function formation(){
        return $this->hasMany(formation::class,"user_id","id");
      }


       public function formationQual(){
        return $this->hasMany(formationQual::class,"user_id","id");
      }

        public function formationContinue(){
        return $this->hasMany(formationContinue::class,"user_id","id");
      }

       public function apprentissage(){
        return $this->hasMany(apprentissage::class,"user_id","id");
      }

      public function ped(){
        return $this->hasMany(ped::class,"user_id","id");
      }
      
      

      
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   
}
