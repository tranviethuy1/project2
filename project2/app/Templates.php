<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    public $table = "templates";
    protected $fillable = [
        'id', 'title', 'create_at', 'linkdownload',
    ];
    public $timestamps = false; 
}
