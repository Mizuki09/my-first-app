<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public function scopeCommentSearch(Builder $query,$id) : Builder
    {
        return $query->where('video_id',$id);
    }
}
