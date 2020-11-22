@extends('layouts.app')

@section('content')
    @auth
    @if(! Auth::user()->active)
        <div class="well" style="background-color: #ff7a7a;color:#333333">
            <h4>此帳號可能已被停權，請聯絡學生會。</h4>
        </div>  
    @endif
    @endauth 

    @if(isset($bulletin->content))
    <div class="well" >
        <div><h5>{{ $bulletin->content }}</h5></div>
    </div>  
    @endif

    <h2>租借項目</h2>
    @if(count($posts) > 0)    
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <img style="width:100%;padding-left:30px;padding-right:30px" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-lg-8 col-sm-12" style="padding-top: 30px">
                        <div style="margin-left:20%">
                            <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                            <h3 style="color:#53575b">${{$post->deposit}}</h3>
                            @if($post->inventory)
                            <h2 style="font-size:20px">剩餘 <b> {!!$post->inventory!!} </b> 個可借用</h2>
                            @else
                            <h4 style="color:#df4c4c;font-size:25px">全數外借中</h4>
                            @endif
                            <div style="height:15px"></div>
                        </div>
                        <form action="{{ url('/cart') }}" method="POST">
                        
                        {!! csrf_field() !!}
                        @auth
                        
                        
                        <input type="hidden" name="inventory" value="{{$post->inventory}}">
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <input type="hidden" name="name" value="{{$post->title}}">
                        <input type="hidden" name="price" value="{{$post->deposit}}">
                        @if($post->inventory)
                        <example-component min="1" max="{{$post->inventory}}"></example-component>
                        @endif
                        @endauth
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