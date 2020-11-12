@extends('layouts.app')

@section('content')
    <h2>設定公告</h2>
        
    {!! Form::open(['action' => 'App\Http\Controllers\BulletinController@edit', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('content', 'Content')}}
            {{Form::textarea('content', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Content Text'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    

@endsection