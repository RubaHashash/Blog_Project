@extends('layouts.index')

@section('content')
    <br>
    <h1>Posts</h1>
    <hr>

    @if(count($posts) > 0)
    <div class="card">
        <ul class="list-group list-group-flush">
            
            @foreach ($posts as $post)

            <div class="row">
                
                <div class="col-md-4">
                    <div style="margin-bottom: 10px">
                        <span class="glyphicon glyphicon-user" style="margin-right: 5px"></span>
                        <label>{{ $post->name }}</label>
                    </div>
                    <img style="width: 50%" src="/storage/app/{{ $post->post_photo_path }}" >
                </div>

                <div class="col-md-8" style="margin-top: 12px">
                    <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                    
                    
                    <div style="margin-bottom: 95px">
                        <label id="count{{$post->id}}" style="margin-right: 10px">{{ $post->likes_count }}</label>
                        <a onclick="likePost({{$post->id}})">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                        </a> 

                        <label style="margin-right: 10px"></label>
                        <a onclick="myFunction({{ $post->id }})">
                            <span class="glyphicon glyphicon-comment"></span>
                        </a>

                        <div style="display: none" id ="add_comment{{ $post->id }}" >
                            <div id="comment_div{{ $post->id }}"></div>
                                
                            <div>
                                <br>
                                <input type="text" placeholder="Add Comment" style="border: 0" id ="comment_input{{ $post->id }}">
                                <a onclick="commentPost({{$post->id}})">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                </a> 
                            </div>
                            
                        </div>
                    </div>

                    <small>Written on {{ $post->created_at }}</small>   
                </div>

                
            </div>
            <hr>

            @endforeach
        </ul>
    </div>
    @else 
        <p>No posts to show.</p>
    @endif
        
@endsection

