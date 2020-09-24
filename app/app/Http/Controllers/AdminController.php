<?php

namespace App\Http\Controllers;
use App\User;
use App\School;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * ユーザーデータの全件表示 20件ずつページネーション
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $school = School::all();
        $items = User::paginate(20);
        $page = 1;
        return view('admin/index',compact('items','school','page'));
    }

    /**
     * ユーザーデータの個別表示
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $school = School::all();
        $item = User::find($id);
        if ($item->school==null) {
            $item->school = "未設定";
        }
        return view('admin/edit',compact('item','school'));
    }

    /**
     * ユーザーデータの編集
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id,Request $request)
    {
        if (is_null($request->school)) {
            User::find($id)->update([
                'role'=>$request->role,
                'school'=>null,
            ]);
        } else {
            User::find($id)->update([
                'role'=>$request->role,
                'school'=>$request->school,
            ]);
        }
        return redirect('/admin');
    }

    /**
     * ユーザーデータの検索(学校別)
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchSchool(Request $request)
    {
        if (is_null($request->school)) {
            $items = User::whereNull('school')->get();
        } else {
            $items = User::where('school',$request->school)->get();
        }
        $school = School::all();
        return view('/admin/index',compact('items','school'));

    }

    /**
     * ユーザーデータの検索(権限別)
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchRole(Request $request)
    {
        $items = User::where('role',$request->role)->get();
        $school = School::all();
        return view('/admin/index',compact('items','school'));
    }
}

