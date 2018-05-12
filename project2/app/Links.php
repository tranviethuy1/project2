<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    public $table ="links";
        protected $fillable = [
        'id_link', 'id_employee', 'id_project'
    ];
    public $timestamps = false;
}
