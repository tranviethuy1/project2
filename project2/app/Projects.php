<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    public $table = "projects";
    public $timestamps = false;

    public function link_project2link(){
    	return $this->hasMany('\App\Links','id_project','id');
    }

    public function link_project2result(){
    	return $this->hasOne('\App\Results','id_project','id');
    }

    public function link_project2advance(){
    	return $this->hasMany('\App\Advances','id_project','id');
    }
}
