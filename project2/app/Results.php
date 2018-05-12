<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    public $table = "results";
    protected $fillable = [
        'id', 'id_employee_r', 'travel_cost_r', 'rent_house_r', 'postage_r', 'postage_document_r', 'others_r', 'overtime', 'benifit' , 'date_finish', 'id_project'
    ];
    public $timestamps = false;
}
