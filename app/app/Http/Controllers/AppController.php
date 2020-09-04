<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Video;
use App\Comment;



class AppController extends Controller
{
    public function  index($category) {
//        動画をカテゴリーごとに取得
//      $videoItems = Video::where('category' , $category)->get()->sortByDesc('created_at');
        $videoItems = Video::where('category' , $category)->orderBy('created_at','DESC')->paginate(5);
//        コメントを動画ごとに取得
//        dd($videoItems);
        $commentItems = Comment::all()->sortByDesc('created_at');

        return view("category/$category" , compact('videoItems' , 'commentItems'));

    }
}

