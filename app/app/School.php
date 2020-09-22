<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = array('id');
    protected $table = 'schools';
    protected $primaryKey = 'id';
}
