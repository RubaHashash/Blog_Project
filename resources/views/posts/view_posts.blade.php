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
                        <img style="width: 50%" src="/storage/app/{{ $post->post_photo_path }}" >
                    </div>

                    <div class="col-md-8">
                        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                        
                        
                        <div style="margin-bottom: 85px">
                            <label id="count{{$post->id}}" style="margin-right: 10px">{{ $post->likes_count }}</label>
                            <a onclick="likePost({{$post->id}})">
                                <span class="glyphicon glyphicon-thumbs-up"></span>
                            </a>                    
                              
                        </div>

                        <small>Written on {{ $post->created_at }}</small>   
                    </div>

                    
                </div>
                <hr>

                @endforeach
            </ul>
        </div>
        @else 

        @endif
@endsection

