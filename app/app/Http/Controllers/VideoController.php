<?php

namespace App\Http\Controllers;
use App\Http\Requests\VideoRequest;
use App\User;
use Illuminate\Http\Request;
use App\Video;
use App\Comment;

class VideoController extends Controller
{
    /**
     * 新しく動画を追加
     * @param VideoRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function videoAdd(VideoRequest $request)
    {
        Video::create($request->all());
        $category = $request->category;
        return redirect("/category/$category");
    }

    /**
     * 動画の削除
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function videodelete(Request $request)
    {
        Comment::CommentSearch($request->video_id)->delete();
        Video::VideoSearch("$request->video_id")->delete();

        return redirect('/');
    }

    /**
     * 公開範囲の変更
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function displayEdit(Request $request,$id) {
        $item = User::find($id);
        $this->authorize('update',$item);
        Video::find($request->video_id)->update([
            'display'=>$request->display,
        ]);
        return redirect("/video/$id");
    }
}
