<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = array('id');
    protected $table = 'videos';
    protected $primaryKey = 'id';

//    Top画面に表示される動画を取得
    public function scopeTopEqual($query,$category) {

        return $query->where('category',$category);

    }

    public function scopeIdSearch($query,$id) {

        return $query->where('user_id',$id);
    }

    public function scopeVideoSearch($query,$id) {

        return $query->where('id',$id);
    }
}
