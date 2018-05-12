<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imformations extends Model
{
    public $table = "imformations";
    protected $fillable = [
        'id', 'male', 'birth','address', 'phone', 'avatar', 'id_employee'
    ];    
    public $timestamps = false;

    public function link_imfor2user(){
    	return $this->belongsTo('App\User','id_employee','id');
    }
}
