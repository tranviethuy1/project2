<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','posision'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    
    public $table = "users";

    public $timestamps = false;

    public function link_user2project(){
        return $this->belongsToMany('\App\Projects','links','id_employee','id_project');
    }

    public function link_user2link(){
        return $this->hasMany('App\Links','id_employee','id');
    }
}
