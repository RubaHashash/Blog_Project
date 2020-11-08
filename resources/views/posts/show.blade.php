@extends('layouts.index')

@section('content')
    <br>
    <h1>{{ $post->title }}</h1>
    <hr>
    
    <div class="row">
        <div class="col-md-4">
            <img style="width: 80%" src="/storage/app/{{ $post->post_photo_path }}" alt="noimage">
        </div>

        <div class="col-md-4">
            <p>{{ $post->body }}</p>
        </div>

        <div class="col-md-4">
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

    </div>
    <br>
    
    <hr>
    <small>Written on {{ $post->created_at }}</small>
    <hr>
    

    @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a>

        <form method = 'POST', action="/posts/{{ $post->id }}", class="pull-right">
            @csrf
            @method('DELETE')
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        </form>
    @endif

@endsection

