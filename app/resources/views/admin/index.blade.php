@extends('layouts.admin')
@section('title', '管理画面')

@section('content')
    <div class="user-flex">
    @foreach($items as $item)
        <div class="user-box">
            <ul>
                <li><span class="user-item">ＩＤ</span>{{$item->id}}</li>
                <li><span class="user-item">名前</span>{{$item->name}}</li>
                <li><span class="user-item">学校</span>{{$item->school}}</li>
                <li><span class="user-item">権限</span>{{$item->role}}</li>
            </ul>
            <li><a href="/admin/{{$item->id}}">編集</a></li>
        </div>
    @endforeach
    </div>
    <div class="paging-system">
        {{$items->links()}}
    </div>
@endsection

