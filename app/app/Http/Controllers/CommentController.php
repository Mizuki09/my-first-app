<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    /**
     * コメントの投稿
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function  commentAdd( CommentRequest $request)
    {
        Comment::create($request->all());
        $category = $request->category;
//        送り元のurlへリダイレクト
        return redirect("/category/$category");
    }

    /**
     * コメントの削除
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function commentdelete( Request $request)
    {
//        該当動画レコードを削除
        Comment::where('id',$request->comment_id)->delete();
        $category = $request->category;
//        送り元のurlへリダイレクト
        return redirect("/category/$category");
    }
}
