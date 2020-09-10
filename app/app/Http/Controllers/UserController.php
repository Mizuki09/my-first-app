<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id) {

        $item = User::find($id);
        $this->authorize('update',$item);
        return  view('edit',compact('item'));

    }

    public function update(Request $request) {
        User::find($request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        return redirect('/');
    }
}
