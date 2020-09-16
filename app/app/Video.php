<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = array('id');
    protected $table = 'videos';
    protected $primaryKey = 'id';

//    カテゴリー毎の動画を取得
    public function scopeTopEqual($query,$category) {

        return $query->where('category',$category);

    }
//    該当しない動画を省く カテゴリー別
    public function scopeLimited($query,$category,$sameNum) {

//        return $query->where('category',$category)->where('display','open')->orwhere('display','limited')->where('user_id',implode(",",$sameNum));
        return $query->where([
            ['category',$category],
            ['display','open']
        ])->orwhere([
            ['category',$category],
            ['display','limited'],
            ['user_id',[implode(",",$sameNum)]]
        ]);
    }

    public function scopeIdSearch($query,$id) {

        return $query->where('user_id',$id);
    }

    public function scopeVideoSearch($query,$id) {

        return $query->where('id',$id);
    }
}
