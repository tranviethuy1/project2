<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    public $table = "plans";
    protected $fillable = [
        'id', 'travel_cost', 'rent_house', 'postage', 'postage_document', 'others' , 'overtime' , 'benifit' , 'days', 'id_project'
    ];    
    public $timestamps = false;

}
