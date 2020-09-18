<?php

namespace App\Http\Controllers;
use App\Comment;
use App\School;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id) {
        $school = School::all();
//        ユーザーデータ編集画面の表示
        $item = User::find($id);
        $this->authorize('update',$item);
        return  view('edit',compact('item','school'));

    }

    public function update(Request $request) {
//        ユーザーデータの変更
        if($request->school == "null"){
            User::find($request->id)->update([
                'name'=>$request->name,
                'school'=>null,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        }else{
            User::find($request->id)->update([
                'name'=>$request->name,
                'school'=>$request->school,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        }


        return redirect('/');
    }

    public function postVideo($id) {
        $item = User::find($id);
        $this->authorize('update',$item);
        $comments = Comment::all()->sortByDesc('created_at');
        $video = Video::IdSearch($id)->get()->sortByDesc('created_at');
        return view('post',compact('video','comments'));
    }
}
