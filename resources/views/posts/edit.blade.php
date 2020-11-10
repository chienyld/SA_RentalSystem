@extends('layouts.app')

@section('content')
    <h1>編輯</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', '品項名稱')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => '名稱'])}}
        </div>
        <div class="form-group">
            {{Form::label('deposit', '押金')}}
            {{Form::number('deposit', 'value', ['class' => 'form-control', 'placeholder' => '押金'])}}
        </div>
        <div class="form-group">
            {{Form::label('inventory', '當前數量')}}
            {{Form::number('inventory', 'value', ['class' => 'form-control', 'placeholder' => '此為當前可外借數量 不包含外借中數量'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', '類別')}}<br>
            {{Form::label('器材Ａ', '器材Ａ')}}
            {{Form::radio('type', '0', ['class' => 'form-control'])}}
            {{Form::label('器材Ｂ', '器材Ｂ')}}
            {{Form::radio('type', '1', ['class' => 'form-control'])}}
            {{Form::label('場地', '場地')}}
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