@extends('layouts.admin')
@section('title', 'ユーザー管理画面')

@section('content')
<div class="user-edit">
    <form method="post" action={{"/admin/edit/$item->id"}}>
        <div class="user-item">
            ID：<span>{{$item->id}}</span>
        </div>
        <div class="user-item">
            名前：<span>{{$item->name}}</span>
        </div>
        <div class="user-item">
            <label for="school">学校：{{$item->school}}</label>
            <input id="school" type="text" name="school">
        </div>
        <div class="user-item">
            <label for="role">権限：{{$item->role}}</label>
            <select id="role" name="role">
                <option value="admin">管理者</option>
                <option value="general">一般</option>
            </select>
        </div>
        @csrf
        <div class="user-item">
            <button type="submit" class="btn btn-primary">
                {{ __('更新') }}
            </button>
        </div>
    </form>
</div>
@endsection
