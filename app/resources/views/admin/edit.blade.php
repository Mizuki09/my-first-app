@extends('layouts.admin')
@section('title', 'ユーザー管理画面')

@section('content')
<div class="user-edit">
    <form method="post" action={{"/admin/edit/$item->id"}}>
        <div class="user-item">
            <label for="id">ID</label>
            <input id="id" type="text" name="id" value={{$item->id}}>
        </div>
        <div class="user-item">
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value={{$item->name}}>
        </div>
        <div class="user-item">
            <label for="school">学校</label>
            <input id="school" type="text" name="school" value={{$item->school}}>
        </div>
        <div class="user-item">
            <label for="role">権限</label>
            <input id="role" type="text" name="role" value={{$item->role}}>
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
