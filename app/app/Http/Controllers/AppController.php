<?php

namespace App\Http\Controllers;
use App\Video;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller
{
    public function  index($category) {
//        動画をカテゴリーごとに取得
//      $videoItems = Video::where('category' , $category)->get()->sortByDesc('created_at');

//        ユーザー情報を取得
        $user = Auth::user();
//        userに何も入っていない場合(ログインしていない場合)
        if ($user == null) {
//            全体公開になっている(open)動画のみを表示させる
            $videoItems = Video::TopEqual($category)->where('display','open')->orderBy('created_at','DESC')->paginate(5);
        }else{
//            全体公開になっている動画＋自分と同じschoolの人が投稿したものも見れる
            $sameSchool = User::where('school',$user->school)->get();
            foreach ($sameSchool as $item) {
                $sameNum[] = $item->id;
            }
            $videoItems = Video::Limited($category,$sameNum)->orderBy('created_at','DESC')->paginate(5);
        }
//        コメントを動画ごとに取得
        $commentItems = Comment::all()->sortByDesc('created_at');

        return view("category/$category" , compact('videoItems' , 'commentItems'));

    }
}

