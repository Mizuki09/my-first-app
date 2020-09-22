<?php

namespace App\Http\Controllers;
use App\Http\Requests\ApiRequest;
use App\Video;
use Google_Client;
use Google_Service_YouTube;

class ApiController extends Controller
{
    /**
     * google youtube APIを使用
     * 動画の自動検索
     * @param ApiRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function apiVideo(ApiRequest $request)
    {
        $DEVELOPER_KEY = config('database.apiKey');
        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);
        $youtube = new Google_Service_YouTube($client);

        $response = $youtube->search->listSearch('id,snippet', array
        (
            //検索方法指定　qはキーワード、orderは新着や再生回数順
            'q' => $request->keyword,
            'videoCategoryId' => $request->categoryId,
            'maxResults' => '20',
            'type' => 'video',
            'regionCode' => 'JP',
            'order' => $request->order,
            'safeSearch' => 'moderate',
        ));

        $item = $response[rand(0 , 19)]->id->videoId;
//        該当した動画のIDを保存
        $request['url'] ='https://www.youtube.com/watch?v=' . $item;

        Video::create($request->all());
        $category = $request->category;

        return redirect("/category/$category");
    }
}
