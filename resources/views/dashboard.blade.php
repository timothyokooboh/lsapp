@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 <div>
                    <a href="/posts/create" class="btn btn-secondary">Create post</a>
                 </div>

                    <h3>Your blog posts</h3>
                @if(count($post) > 0)
                    <table class="table table-striped">
                      <tr>
                         <th>Title</th>
                         <th>Edit</th>
                         <th class="float-right">Delete</th>
                      </tr>
                        @foreach($post as $posts)
                         <tr>
                         <td><a href="/posts/{{$posts->id}}">{{$posts->title}}</a></td>
                            <td>
                              <a href="/posts/{{$posts->id}}/edit" class="btn btn-secondary">Edit
                               </a>
                            </td>
                            <td>
                                {!!Form::open(['action'=>['PostsController@destroy', $posts->id], 'method' =>'POST', 'class'=>'float-right'])!!}

                                @method('DELETE')
                                {{Form::submit('DELETE', ['class'=>'btn btn-danger'])}}

                                {!!Form::close()!!} 
                            </td>
                         </tr>
                           
                        @endforeach
                    @else
                      <p>You have no post</p>
                    @endif
                    </table>   

                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
