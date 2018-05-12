<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
   	public $table = 'notices';
   	protected $fillable = [
        'id', 'title', 'content', 'create_at', 'linkdownload', 'id_employee'
    ];
   	public $timestamps = false;
}
