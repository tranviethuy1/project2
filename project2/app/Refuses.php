<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refuses extends Model
{
    public $table = "refuses";
    protected $fillable = [
        'id', 'id_admin', 'reason', 'create_at'
    ];    
    public $timestamps = false;
}
