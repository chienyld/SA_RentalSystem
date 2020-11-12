@extends('layouts.app')

@section('content')
    @auth
    @if(! Auth::user()->active)
        <div class="container" style="background-color: #ff8b8b;border-radius:5px;width:100%;margin-bottom:10px">
            <div><h4>帳號可能已被停權，請聯絡學生會。</h4></div>
        </div>  
    @endif
    @endauth 

    @if($bulletin->content)
    <div class="container" style="background-color: #f0f0f0;border-radius:5px;width:100%;margin-bottom:10px">
        <div class="form-group"><h5>{{ $bulletin->content }}</h5></div>
    </div>  
    @endif

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
                        <h2 style="font-size:25px">剩餘 <b> {!!$post->inventory!!} </b> 個可借用</h2>
                        @else
                        <h4 style="color:#d22929;font-size:25px">全數外借中</h4>
                        @endif
                        <div style="height:30px"></div>
                        
                        <form action="{{ url('/cart') }}" method="POST" class="col-4">
                        
                        {!! csrf_field() !!}
                        @auth
                        
                        @endauth
                        <input type="hidden" name="inventory" value="{{$post->inventory}}">
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <input type="hidden" name="name" value="{{$post->title}}">
                        <input type="hidden" name="price" value="{{$post->deposit}}">
                        @if($post->inventory)
                        <example-component min="1" max="{{$post->inventory}}"></example-component>
                        @endif
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