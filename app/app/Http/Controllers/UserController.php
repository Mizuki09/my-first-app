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
}
