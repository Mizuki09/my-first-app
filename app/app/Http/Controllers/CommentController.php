<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function  commentAdd( CommentRequest $request) {
        Comment::create($request->all());
        $category = $request->category;

//        送り元のurlへリダイレクト
        return redirect("/category/$category");
    }

    public function commentdelete( Request $request) {
//        該当動画レコードを削除
        Comment::where('id',$request->comment_id)->delete();
        $category = $request->category;

//        送り元のurlへリダイレクト
        return redirect("/category/$category");
    }
}
