@extends('layouts.admin')
@section('title', '管理画面')

@section('content')
    <div class="user-flex">
    @foreach($items as $item)
        <div class="user-box">
            <ul>
                <li><span class="user-item">ID</span>{{$item->id}}</li>
                <li><span class="user-item">名前</span>{{$item->name}}</li>
                <li><span class="user-item">学校名</span>{{$item->school}}</li>
                <li><span class="user-item">権限</span>{{$item->role}}</li>
            </ul>
        </div>
    @endforeach
        <div class="paging-system">
            {{$items->links()}}
        </div>
    </div>
@endsection

