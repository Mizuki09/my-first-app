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
            <label for="school">学校：@if(is_null($item->school)){{$school[$item->school-1]->name}}@else未設定@endif</label>
            <select id="school" name="school">
                <option value="">未設定</option>
                @foreach($school as $schoolItem)
                    <option value="{{$schoolItem->id}}">{{$schoolItem->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="user-item">
            <label for="role">権限：{{$item->role}}</label>
            <select id="role" name="role">
                <option value="general">general</option>
                <option value="admin">admin</option>
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
