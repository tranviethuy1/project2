<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advances extends Model
{
    public $table ="advances";
    protected $fillable = [
        'id', 'id_employee', 'advance_date', 'travel_cost', 'rent_house', 'postage' , 'postage_document' , 'others' , 'id_project'
    ];    
    public $timestamps = false;
}
