@extends('layouts.app')
@section('title', 'TOP')
@section('content')
    <div class="flex-container">
        @foreach($categoryList as $item)
            <div class="category">
                <a href="{{ url($item[0]) }}">{{$item[1]}}</a>
                <div class="main-aria">
                    @if($response[$item[2]] == null)
                        <div id="sample-image">
                            <a href="https://www.youtube.com/">
                                <img src="https://av.watch.impress.co.jp/img/avw/docs/1078/251/yl1.jpg" >
                            </a>
                        </div>
                    @else
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ str_replace('https://www.youtube.com/watch?v=' , '' , $response[$item[2]]->url) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @endif
                </div>
            </div>
        @endforeach
@endsection
