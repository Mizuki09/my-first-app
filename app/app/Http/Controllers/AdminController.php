<?php

namespace App\Http\Controllers;
use App\User;
use App\School;
use Illuminate\Http\Request;

class AdminController extends Controller
{
//    ユーザーデータの全件表示(20件ずつ)
    public function index() {
        $school = School::all();
        $items = User::paginate(20);
        $page = 1;
        return view('admin/index',compact('items','school','page'));

    }
//    ユーザーデータの個別表示
    public function edit($id) {
        $school = School::all();
        $item = User::find($id);
        if ($item->school==null){
            $item->school = "未設定";
        }
        return view('admin/edit',compact('item','school'));
    }
//    ユーザーデータの編集
    public function update($id,Request $request) {
        if ($request->school =="null") {
            User::find($id)->update([
                'role'=>$request->role,
                'school'=>null,
            ]);
        }else{
            User::find($id)->update([
                'role'=>$request->role,
                'school'=>$request->school,
            ]);
        }

        return redirect('/admin');
    }
//    ユーザーデータの検索
    public function searchSchool(Request $request) {
        if ($request->school =="null"){
            $items = User::whereNull('school')->get();
        }else{
            $items = User::where('school',$request->school)->get();
        }


        $school = School::all();
        return view('/admin/index',compact('items','school'));

    }

    public function searchRole(Request $request) {

        $items = User::where('role',$request->role)->get();

        $school = School::all();
        return view('/admin/index',compact('items','school'));
    }
}
