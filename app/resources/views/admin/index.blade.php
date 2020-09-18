@extends('layouts.admin')
@section('title', '管理画面')

@section('content')
    <div class="search-menu">
        <div class="search-list">
            <form method="post" action="{{url('search/school')}}">
                <div>
                    <label for="school">学校</label>
                    <select id="school" name="school">
                        <option value=null>未設定</option>
                        @foreach($school as $schoolItem)
                            <option value="{{$schoolItem->id}}">{{$schoolItem->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('検索') }}
                </button>
                @csrf
            </form>
        </div>
        <div class="search-list">
            <form method="post" action="{{url('search/role')}}">
                <div>
                    <label for="role">権限</label>
                    <select id="role" name="role">
                        <option value=null>未設定</option>
                        <option value="admin">admin</option>
                        <option value="general">general</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('検索') }}
                </button>
                @csrf
            </form>
        </div>
    </div>

    <div class="user-flex">
    @foreach($items as $item)
        <div class="user-box">
            <p>ＩＤ：{{$item->id}}</p>
            <p>名前：{{$item->name}}</p>
            <form method="post" action={{"/admin/edit/$item->id"}}>
                <label for="school">学校：@if($item->school == null)未設定@else{{$school[$item->school-1]->name}}@endif</label>
                <select id="school" name="school">
                    <option value=null>未設定</option>
                    @foreach($school as $schoolItem)
                        <option value="{{$schoolItem->id}}">{{$schoolItem->name}}</option>
                    @endforeach
                </select>
                <label for="role">権限：@if($item->role == null)未設定@else{{$item->role}}@endif</label>
                <select id="role" name="role">
                    <option value="general">general</option>
                    <option value="admin">admin</option>
                </select>
                <div class="user-item">
                    <button type="submit" class="btn btn-primary">
                        {{ __('更新') }}
                    </button>
                </div>
                @csrf
            </form>
        </div>
    @endforeach
    </div>
    @if(isset($page))
    <div class="paging-system">
        {{$items->links()}}
    </div>
    @else
    @endif
@endsection

