<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Likes;
use App\Models\Comments;

use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
     // display all the posts
     public function viewPosts(){
        // $posts = Posts::orderBy('created_at','desc')->get();
        // return view('posts.view_posts', compact('posts'));

        $posts= Posts::orderBy('created_at','desc')
        ->join('users','users.id',"=", "posts.user_id")
        ->select("posts.*","users.name")->get();

        return view('posts.view_posts', compact('posts'));

    }

    public function viewMyPosts() {
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


    public function LikePost(Request $request){
        
        $ifexist= Likes::where("user_id", "=", Auth::user()->id)->where("post_id","=",$request->id)->first();
        
        if($ifexist==null){
         $like = new Likes;
         $like->post_id=$request->id;
         $like->user_id=Auth::user()->id;
         $like->save();
        }
        else{
            Likes::where("user_id", "=", Auth::user()->id)->where("post_id","=",$request->id)->delete();
        }
    }

    public function count_like(Request $request){
        $count= Likes::where("post_id","=",$request->id)->count();
        
        $post = Posts::find($request->id);
        $post->likes_count = $count;
        $post->save();
        
        return $count;
    }


    public function CommentPost(Request $request){
        
        $comment = new Comments;

        $comment->post_id=$request->id;
        $comment->text = $request->text;
        $comment->user_id=Auth::user()->id;
        
        $comment->save();
        
    }


    public function displayComment(Request $request){
        
        $result= Comments::orderBy('created_at','asc')->where("post_id","=",$request->id)
        ->join('users','users.id',"=", "comments.user_id")
        ->select("comments.*","users.name")->get();
        
        return $result;
    }


    
}
