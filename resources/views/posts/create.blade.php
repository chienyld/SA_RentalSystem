@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', '品項')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('deposit', '押金')}}
            {{Form::number('deposit', 'value', ['class' => 'form-control', 'placeholder' => 'security deposit'])}}
        </div>
        <div class="form-group">
            {{Form::label('inventory', '數量')}}
            {{Form::number('inventory', 'value', ['class' => 'form-control', 'placeholder' => 'inventory'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', '類別')}}<br>
            {{Form::label('type', 'Ａ')}}
            {{Form::radio('type', '0', ['class' => 'form-control'])}}
            {{Form::label('type', 'Ｂ')}}
            {{Form::radio('type', '1', ['class' => 'form-control'])}}
            {{Form::label('type', '場地')}}
            {{Form::radio('type', '2', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection