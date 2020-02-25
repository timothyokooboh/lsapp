@extends('layouts.app1')

@section('content')

<h1>Blog posts</h1>

  @foreach($post as $posts)
     <div class="card card-body bg-light mb-5">
       <div class="row">
           <div class="col-md-4 col-sm-4">
           
               <img src="/storage/cover_images/{{$posts->cover_image ??profile.jpg}}" class="w-100"> 

           </div> 
           <div class="col-md-8 col-sm-8">
                <h3 class="pl-3 pt-1">{{$posts->title}}</h3>
                <small class="pl-3">Written on {{$posts->created_at}} by {{$posts->user->name}}</small>
           </div>    
       </div>
        
        <a href="/posts/{{$posts->id}}">Read post</a>
     </div>
  @endforeach
  <div class="d-flex justify-content-center">
    {{$post->links()}} 
  </div>
  
@endsection