@extends('layouts.app')

@section('content')
    <h2>租借項目</h2>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small></br></br>
                        <form action="{{ url('/cart') }}" method="POST">
                        {!! csrf_field() !!}
                        <input class="btn-primary" type="submit" value="borrow">
                        <input class="btn-primary" value="more" onclick="location.href='/posts/{{$post->id}}'" style="background-color:#BDBDBD">
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection