<?php

namespace App\Http\Controllers;
use App\Comment;
use App\School;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザーデータ編集画面の表示
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $item = User::find($id);
        $this->authorize('update',$item);
        $school = School::all();
        return  view('edit',compact('item','school'));
    }
    /**
     * ユーザーデータの変更
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        if (is_null($request->school)) {
            User::find($request->id)->update([
                'name'=>$request->name,
                'school'=>null,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        } else {
            User::find($request->id)->update([
                'name'=>$request->name,
                'school'=>$request->school,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        }
        return redirect('/');
    }

    /**
     * ユーザー毎の投稿動画の一覧管理
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function postVideo($id)
    {
        $item = User::find($id);
        $this->authorize('update',$item);
        $comments = Comment::all()->sortByDesc('created_at');
        $video = Video::IdSearch($id)->get()->sortByDesc('created_at');
        return view('post',compact('video','comments'));
    }
}

