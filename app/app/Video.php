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
}
