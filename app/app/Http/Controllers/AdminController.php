<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
//    ユーザーデータの全件表示(20件ずつ)
    public function index() {
        $items = User::paginate(20);
        return view('admin/index',compact('items'));

    }
//    ユーザーデータの個別表示
    public function edit($id) {
        $item = User::find($id);
        if ($item->school==null){
            $item->school = "未設定";
        }
        return view('admin/edit',compact('item'));
    }
//    ユーザーデータの編集
    public function update($id,Request $request) {
        User::find($id)->update([
            'role'=>$request->role,
            'school'=>$request->school,
        ]);
        return redirect('/admin');
    }
}
