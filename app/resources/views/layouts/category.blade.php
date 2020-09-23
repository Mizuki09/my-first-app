<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('TOP', 'TOP') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
                                {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if(Auth::user()->role == "admin")
                                            <a class="dropdown-item" href="{{ url("admin") }}">
                                                {{ __('ユーザー管理') }}
                                            </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ url("edit".'/'.Auth::user()->id) }}">
                                            {{ __('登録情報の編集') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ url("video".'/'.Auth::user()->id) }}">
                                            {{ __('投稿動画の管理') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                            {{ __('ログアウト') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                        <ul class="navbar-nav ml-auto">
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <div class="post-video">
                    {{--        APIを使った動画の自動検索と自動投稿--}}
                    <div class="post-aria">
                        <form method="post" action="apiCreate">
                            <label for="text">動画を探して投稿</label>
                            <input type="hidden" name="category" value="@yield('category')">
                            <input type="hidden" name="categoryId" value="@yield('categoryNum')">
                            <input type="hidden" name="display" value="open">
                            <input type="text" name="keyword" placeholder="キーワード" >
                            {{--            ログインしていない場合--}}
                            @guest
                                {{--            ログインしている場合--}}
                            @else
                                <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                            @endguest
                            <select name="order">
                                <option value="date">新着</option>
                                <option value="rating">評価が高い</option>
                                <option value="relevance">関連性</option>
                                <option value="viewCount">再生数</option>
                            </select>
                            <input type="submit" value="探す">
                            @csrf
                        </form>
                        @foreach ($errors->get('keyword') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    {{--        動画を投稿するフォーム--}}
                    <div class="post-aria">
                        <form method="post" action="videoCreate">
                            <label for="text">動画を投稿する</label>
                            <input class="post-text" type="url" name="url" id="text" value="https://www.youtube.com/watch?v=XXXXXXXXX">
                            {{--            ログインしていない場合--}}
                            @guest
                                {{--            ログインしている場合--}}
                            @else
                                <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                            @endguest
                            <input type="hidden" name="category" value="@yield('category')">
                            <input type="submit" name="foo" value="投稿">
                            @csrf
                            <label for="limited">公開範囲</label>
                            <select id="limited" name="display">
                                <option value="open">全体公開</option>
                                <option value="limited">スクール限定</option>
                            </select>
                        </form>
                        {{--        注意文--}}
                        <span id="url-warning">※</span>XXXXXXXXXを動画IDに変更してください
                        @foreach ($errors->get('url') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
                <div class="flex-container2">
                    @foreach($videoItems as $video)
                        <div class="main">
                            <div class="main-aria2">　
                                <div>
                                    {{--                        埋め込み動画を表示--}}
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ str_replace('https://www.youtube.com/watch?v=' , '' , $video->url)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="main-log">
                                    <div class="comments">
                                        {{--                            表示される動画に対応するコメントを表示--}}
                                        @foreach($commentItems as $comment)
                                            @if($video->id == $comment->video_id)
                                                <li class="comment">
                                                    {{--                                            コメント内容を表示--}}
                                                    <span class="comment_body">{{ $comment->body }}</span>
                                                    {{--                                            作成日時を表示--}}
                                                    <span class="comment_time">{{$comment->created_at}}</span>
                                                    {{--                                            ログインしていない場合--}}
                                                    @guest
                                                        {{--                                            ログインしている場合--}}
                                                    @else
                                                        {{--                                            コメントの投稿者IDとログインしているユーザーをIDが一致している場合--}}
                                                        @if(Auth::user()->id == $comment->user_id )
                                                            <div class="delete-comment">
                                                                <form method="post" action="commentDelete">
                                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                                    <input type="hidden" name="category" value="@yield('category')">
                                                                    <input type="submit" name="commentDelete" value="削除">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endguest
                                                </li>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--                コメントを投稿するフォーム--}}
                            <form method="post" action="commentCreate">
                                <div class="new-comment">

                                    <input type="hidden" name="video_id" value="{{$video->id}}">
                                    <input type="hidden" name="category" value="@yield('category')">
                                    {{--                        ログインしていない場合--}}
                                    @guest
                                        {{--                        ログインしている場合--}}
                                    @else
                                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                                    @endguest
                                    <input type="text" name="body">
                                    <input type="submit" name="bar" value="送信">
                                </div>
                                @csrf
                            </form>
                            {{--                ログインしていない場合--}}
                            @guest
                                {{--                ログインしている場合--}}
                            @else
                                {{--                動画の投稿者IDとログインしているユーザーをIDが一致している場合--}}
                                @if(Auth::user()->id == $video->user_id)
                                    {{--                        動画の削除--}}
                                    <div class="delete-button">
                                        <form method="post" action="videoDelete">
                                            <input type="hidden" name="video_id" value="{{$video->id}}">
                                            <input type="hidden" name="category" value="@yield('category')">
                                            <input type="submit" name="videoDelete" value="動画を削除">
                                            @csrf
                                        </form>
                                    </div>
                                @endif
                            @endguest
                        </div>
                    @endforeach
                    <div class="paging-system">
                        {{$videoItems->links()}}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
