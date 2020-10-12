@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => '名稱'])}}
        </div>
        <div class="form-group">
            {{Form::label('deposit', 'Deposit')}}
            {{Form::number('deposit', 'value', ['class' => 'form-control', 'placeholder' => '押金'])}}
        </div>
        <div class="form-group">
            {{Form::label('inventory', 'Inventory')}}
            {{Form::number('inventory', 'value', ['class' => 'form-control', 'placeholder' => '此為當前可外借數量 非器材總數量'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', 'Type')}}<br>
            {{Form::label('type', 'Type0')}}
            {{Form::radio('type', '0', ['class' => 'form-control'])}}
            {{Form::label('type', 'Type1')}}
            {{Form::radio('type', '1', ['class' => 'form-control'])}}
            {{Form::label('type', 'Type2')}}
            {{Form::radio('type', '2', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection