@extends('layouts.app1')
@section('content')
   <h1>Create Post</h1>
   {!! Form::open(['action'=>'PostsController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
      </div>
      <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Type your article'])}}
      </div> 
      <div>
         {{Form::label('cover_image', 'Upload image')}}
         {{Form::file('cover_image')}}
      </div>
      <div class="mt-3">
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
      </div>
        
     
   {!! Form::close() !!}
@endsection