<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws GuzzleException
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
//        カテゴリ毎に一番投稿時間の新しいものをTOPに表示させる
        foreach ($category as $item) {
            $response[] = Video::where('category' , "$item[0]")->get()->sortbyDesc('created_at')->first();
        }

        return view('index' , compact('response' , 'category'));
    }
}
