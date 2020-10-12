@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <div style="padding:40px">
    <h1>{{$post->title}}</h1>
    <div class="col-lg-6 col-sm-10" style="padding:20px;margin:20px">
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    </div>
    <br><br>
    <div class="showboard">
    <div>
        type {!!$post->type!!}
    </div>
    <div>
        deposit ${!!$post->deposit!!}
    </div>
    <div>
        {!!$post->inventory!!} available
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    </div></div>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection