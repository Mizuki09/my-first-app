<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
use App\Video;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * TOP画面の動画の表示
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        カテゴリー情報
        $categoryList = config('const.category');
//        ユーザー情報
        $user = Auth::user();

        if (is_null($user)) {
            foreach ($categoryList as $item) {
                $response[] = Video::TopEqual($item[0])->first();;
            }
        } else {
//            Numには同じスクールの人のidを格納
            $Num = User::where('school',$user->school)->get('id');
            //            全体公開になっている動画＋自分と同じschoolの人が投稿したものも見れる
            foreach ($categoryList as $item) {
                $response[] = Video::Limited($item[0],$Num)->first();
            }
        }
        return view('index' , compact('response' , 'categoryList'));
    }
}
