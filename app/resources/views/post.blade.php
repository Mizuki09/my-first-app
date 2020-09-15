@extends('layouts.app')
@section('title', 'TOP')

@section('content')
    @foreach($video as $item)
        <div class="main-aria3">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ str_replace('https://www.youtube.com/watch?v=' , '' , $item->url) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="comments">
                {{--                            表示される動画に対応するコメントを表示--}}
                @foreach($comments as $comment)
                    @if($item->id == $comment->video_id)
                        <li class="comment">
                            {{--                                            コメント内容を表示--}}
                            <span class="comment_body">{{ $comment->body }}</span>
                            {{--                                            作成日時を表示--}}
                            <span class="comment_time">{{$comment->created_at}}</span>
                            {{--                                            ログインしていない場合--}}
                        </li>
                    @endif
                @endforeach
            </div>
            <div class="limited">
                <p>現在の設定：{{$item->display}}</p>
                <form method="post" action="{{Auth::user()->id}}/display">
                    <input type="hidden" name="video_id" value="{{$item->id}}">
                    <label for="display">公開範囲</label>
                    <select name="display" id="display">
                        <option value="open">全体公開</option>
                        <option value="limited">スクール限定</option>
                    </select>
                    @csrf
                    <input type="submit" value="更新">
                </form>
            </div>
        </div>
        <div class="delete-button2">
            <form method="post" action="videoDelete">
                <input type="hidden" name="video_id" value="{{$item->id}}">
                <input type="hidden" name="category" value="{{$item->category}}">
                <input type="submit" name="videoDelete" value="動画を削除">
                @csrf
            </form>
        </div>

    @endforeach
@endsection

