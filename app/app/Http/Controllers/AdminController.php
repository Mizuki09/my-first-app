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
}
