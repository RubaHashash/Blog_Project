<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
     // display all the posts
     public function viewPosts(){
         
        $posts = Posts::orderBy('created_at','desc')->get();
        return view('posts.view_posts', compact('posts'));
    }

    public function viewMyPosts(){

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('posts.user_posts')->with('posts', $user->posts);
    }

    // shows the form for creating a new post
    public function create(){
        return view('posts.create_posts');
    }


    // stores the created post in database
    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'post_photo_path' => 'image|nullable|max:1999'
        ]);

        //handle the file upload
        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
        }else
        {
            $image = "noimage.jpeg";
        }

        $post = new Posts();
        $post->user_id = Auth::user()->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->post_photo_path = $request->file('image')->storeAs('/storage', $image);
        $post->save();

        return redirect('/posts');
    }


    // display a specific post
    public function show($id){

        $post = Posts::find($id);
        return view('posts.show', compact('post'));
    }


    // shows the form for editing a post
    public function edit($id){

        $post = Posts::find($id);
        
        if(Auth::user()->id !== $post->user_id )
        {
            return redirect('/posts');
        }
        
        return view('posts.edit', compact('post'));
    }


    // updating the post in database
    public function update(Request $request, $id){

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'post_photo_path' => 'image|nullable|max:1999'
        ]);

        //handle the file upload
        if($request->hasFile('image')){
            $image = $request->file('image')->getClientOriginalName();
        }

        $post = Posts::find($id);
        // $post->user_id = 1;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image')){
            $post->post_photo_path = $request->file('image')->storeAs('/storage', $image);
        }

        $post->save();

        return redirect('/posts');
    }


    //remove post
    public function destroy($id){

        $post = Posts::find($id);

        if(Auth::user()->id !== $post->user_id )
        {
            return redirect('/posts');
        }

        $post->delete();

        return redirect('/posts');
    }
}
