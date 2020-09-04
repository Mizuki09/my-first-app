<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');
    protected $table = 'Comments';
    protected $primaryKey = 'id';
}
