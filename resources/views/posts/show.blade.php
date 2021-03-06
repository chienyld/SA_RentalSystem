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
    <div style="padding:10px">                   
    <div style="font-size:1.1em;color:#0f4c81">
        押金 ${!!$post->deposit!!}
    </div>
    <div style="font-size:1em;color:#3f5d91">
        剩餘 <b> {!!$post->inventory!!} </b> 個可借用
    </div>
    <div style="font-size:0.8em">
        {!!$post->body!!}
    </div></div>
    <form action="{{ url('/cart') }}" method="POST" class="col-4">
    {!! csrf_field() !!}
    @auth
    
    @endauth
    <input type="hidden" name="inventory" value="{{$post->inventory}}">
    <input type="hidden" name="id" value="{{$post->id}}">
    <input type="hidden" name="name" value="{{$post->title}}">
    <input type="hidden" name="price" value="{{$post->deposit}}">
    <example-component min="1" max="{{$post->inventory}}"></example-component>
    </form>

    <hr>
    <small style="font-size:0.5em;">Written on {{$post->created_at}} by {{$post->user->name}}</small>
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