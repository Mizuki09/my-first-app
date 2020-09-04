<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = array('id');
    protected $table = 'Videos';
    protected $primaryKey = 'id';
}
