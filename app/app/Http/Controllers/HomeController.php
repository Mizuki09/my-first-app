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
        $category = [
//          カテゴリ名、タイトル、該当動画番号
            ['animal' , '動物' ,'0'],
            ['cooking' , '料理' ,'1'],
            ['game' , 'ゲーム' ,'2'],
            ['music' , '音楽' ,'3'],
            ['sports' , 'スポーツ' ,'4'],
            ['travel' , '旅行' ,'5']
        ];
        $user = Auth::user();

        if ($user == null) {
            foreach ($category as $item) {
                $response[] = Video::TopEqual($item[0])->where('display','open')->orderBy('created_at','DESC')->first();
            }
        }else {
//            Numには同じスクールの人のidを格納
            $Num = User::where('school',$user->school)->get('id');
            //            全体公開になっている動画＋自分と同じschoolの人が投稿したものも見れる
            foreach ($category as $item) {
                $response[] = Video::Limited($item[0],$Num)->orderBy('created_at','DESC')->first();
            }
        }
        return view('index' , compact('response' , 'category'));
    }
}
