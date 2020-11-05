<?php

namespace App\Http\Controllers;
use App\Models\Posts;

use Illuminate\Http\Request;


class PostsController extends Controller
{
     // display all the posts
     public function viewPosts()
     {
        $posts = Posts::orderBy('created_at','desc')->get();
        return view('posts.view_posts', compact('posts'));
    }


    // shows the form for creating a new post
    public function create()
    {
        return view('posts.create_posts');
    }


    // stores the created post in database
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Posts();
        $post->user_id = 1;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts');
    }


    // display a specific post
    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show', compact('post'));
    }


    // shows the form for editing a post
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('posts.edit', compact('post'));
    }


    // updating the post in database
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Posts::find($id);
        // $post->user_id = 1;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts');
    }


    //remove post
    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();

        return redirect('/posts');
    }
}
