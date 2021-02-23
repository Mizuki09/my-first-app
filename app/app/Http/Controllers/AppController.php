<?php

namespace App\Http\Controllers;
use App\Video;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller
{
    /**
     * 動画をカテゴリーごとに取得
     * @param $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  index($category)
    {
//        カテゴリー情報
        $categoryList = config('const.category');
        $categoryNum = array_search($category, array_column($categoryList, 0));
        $list = $categoryList[$categoryNum];

//        ユーザー情報を取得
        $user = Auth::user();
//        userに何も入っていない場合(ログインしていない場合)
        if (is_null($user)) {
//            全体公開になっている(open)動画のみを表示させる
            $videoItems = Video::TopEqual($category)
                ->where('display','open')->orderBy('created_at','DESC')
                ->paginate(5);
        }else {
//            全体公開になっている動画＋自分と同じschoolの人が投稿したものも見れる
            $Num = User::where('school',$user->school)->get('id');
            $videoItems = Video::Limited($category,$Num)
                ->orderBy('created_at','DESC')
                ->paginate(5);
        }
//        コメントを動画ごとに取得
        $commentItems = Comment::all()->sortByDesc('created_at');
        return view("/list" , compact('videoItems', 'commentItems', 'list'));

    }
}

