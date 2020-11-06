<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comments;
use App\Models\Posts;
use Session;

class CommentsController extends Controller
{
    public function index()
     {

    }

    // shows the form for creating a new comment
    public function create()
    {
       
    }


    // stores the created comment in database
    public function store(Request $request, $post_id)
    {
        $this->validate($request,[
            'text' => 'required|min:5|max:2000'
        ]);

        $post = Posts::find($post_id);

        $comment = new Comments();
        $comment->user_id = Auth::user()->id;
        $comment->text = $request->input('text');
        $comment->post()->associate($post);

        $comment->save();

        Session::flash('Success', 'Comment was added');

        return redirect('/posts', compact('post'));
    }


    // display a specific comment
    public function show($id)
    {
        
    }


    // shows the form for editing a comment
    public function edit($id)
    {
        
    }


    // updating the comment in database
    public function update(Request $request, $id)
    {
        
    }


    //remove post
    public function destroy($id)
    {
        
    }
}
