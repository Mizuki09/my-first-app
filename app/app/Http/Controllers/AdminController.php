<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $items = User::paginate(20);
        return view('admin/index',compact('items'));
    }

    public function edit($id){
        $item = User::find($id);
        return view('admin/edit',compact('item'));
    }
}
