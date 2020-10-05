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
                        <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <h3 style="color:#3097D1">${{$post->deposit}}</h3>
                        @if($post->inventory)
                        <h3 >{{$post->inventory}}available</h3>
                        @else
                        <h4>unavailable</h4>
                        @endif
                        </br></br>
                        
                        <form action="{{ url('/cart') }}" method="POST" class="col-4">
                        
                        {!! csrf_field() !!}
                        @auth
                        
                        @endauth
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <input type="hidden" name="name" value="{{$post->title}}">
                        <input type="hidden" name="price" value="{{$post->deposit}}">
                        <div class="col-lg-4 col-md-2 col-sm-2">
                        <input type="number" name="qty" value="qty" class="form-control" placeholder= "quantity">
                        </div>
                        <input class="btn-primary" type="submit" value="Add To List">
                        
                        </form>
                        <!--
                        <div class="col-4">
                        <button class="btn-primary" value="more" onclick="location.href='/posts/{{$post->id}}'" style="background-color:#BDBDBD">more</button>
                        </div>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                        --> 
                    </div>

                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
    

@endsection