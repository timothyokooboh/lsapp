@extends('layouts.app1')
@section('content')
 <a href="/posts" class="btn btn-default" role="button">Go back</a>
  <h1>{{$post->title}}</h1>
  <div>{!!$post->body!!}</div>
  <div><img src="/storage/cover_images/{{$post->cover_image}}" class="w-50"></div>
  <hr>
  <div>This article was created at {{$post->created_at}} by {{$post->user->name}}</div>
  <hr>
  @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
      <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary" role="button">Edit article
      </a>
    
      {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method' =>'POST', 'class'=>'float-right'])!!}

      @method('DELETE')
      {{Form::submit('DELETE', ['class'=>'btn btn-danger'])}}

      {!!Form::close()!!}
  @endif
@endif  
@endsection