<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imformations extends Model
{
    public $table = "imformations";
    public $timestamps = false;

    public function link_imfor2user(){
    	return $this->belongsTo('App\User','id_employee','id');
    }
}
