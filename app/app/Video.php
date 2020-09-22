<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = array('id');
    protected $table = 'videos';
    protected $primaryKey = 'id';

//    カテゴリー毎の動画を取得
    public function scopeTopEqual(Builder $query, $category): Builder
    {
        return $query->where('category', $category);
    }
//    該当しない動画を省く カテゴリー別
    public function scopeLimited($query, $category, $Num)
    {
        return $query->where('category', $category)
            ->where('display', 'open')
            ->orwhere('display', 'limited')
            ->where('category', $category)
            ->whereIn('user_id', $Num);
    }

    public function scopeIdSearch(Builder $query, $id): Builder
    {
        return $query->where('user_id', $id);
    }

    public function scopeVideoSearch(Builder $query, $id): Builder
    {
        return $query->where('id', $id);
    }
}
