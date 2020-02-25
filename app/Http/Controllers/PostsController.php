<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Collective\Html\Eloquent\FormAccessible;
use App\Post;



class PostsController extends Controller
{

    function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    protected $guarded = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('created_at', 'DESC')->paginate(5);
        
        return view('posts.index')->with('post', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        
        
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);
        
        //handle file upload
         if ($request->hasFile('cover_image')) {

            //Get file name with extension

            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName(); 

            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just extension
            $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
             
            //or
            //$extension = $request->file('cover_image')->getClientOriginalExtension(); 

            //file name to store;
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image
            $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
         } else {
            $fileNameToStore = 'noImage.jpg';
         }
        //submit post
        Post::create([
            'title'=>$request['title'],
            'body'=>$request['body'],
            'cover_image'=>$fileNameToStore,
            'user_id'=> auth()->user()->id,
        ]);
        return redirect('/posts')->with('success', 'New post added');

    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('post', $post)->with('error', 'You are unauthorized to visit that page');
        }
           
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $this->validate($request, [
           'title'=>'required',
           'body'=>'required',
           'cover_image' => 'image|nullable|max:1999',
       ] );

                //handle file upload
                if ($request->hasFile('cover_image')) {

                    //Get file name with extension
        
                    $fileNameWithExt = $request->file('cover_image')->getClientOriginalName(); 
        
                    //Get just file name
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        
                    //Get just extension
                    $extension = $request->file('cover_image')->getClientOriginalExtension(); 
        
                    //file name to store
                    $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        
                    //upload image
                    $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
                 } 
         $post = Post::findOrFail($id);
         $post->title = $request['title'];
         $post->body = $request['body'];
         if($request->hasFile('cover_image')){
           $post->cover_image = $fileNameToStore;
         }
         $post->save();

    
       return redirect('/posts')->with('post', $post)->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('post', $post)->with('error', 'You are a bloody hacker');
        }
          
        if($post->cover_image !=='noImage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();

        return redirect('/dashboard')->with('error', "One Post deleted successfully");
    }
}
