@extends ('layouts.app1')
@section ('content')
  <h1>Edit post</h1>
  <p>{{$post->title}}</p>
  {!! Form::open(['action'=>['PostsController@update', $post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
  @method('PATCH')
     
      <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'Title'])}}
      </div>
      <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body, ['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Type your article'])}}
      </div> 
      <div>
         {{Form::label('cover_image', 'Upload image')}}
         {{Form::file('cover_image')}}
      </div>
      <div class="form-group">
        {{Form::submit('Update post', ['class'=>'btn btn-primary'])}}
      </div>
   {!! Form::close() !!}
@endsection 