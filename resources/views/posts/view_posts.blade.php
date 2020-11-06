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
                        <small>Written on {{ $post->created_at }}</small>        
                    </div>
                    

                    {{-- display comments to view --}}
                    {{-- <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @foreach ($post->text as $comment)
                                {{ $comment->text }};
                            @endforeach
                        </div>
                    </div> --}}

                    <div class="col-md-8" style="margin-top: 15px">
                        <form method="POST" action="/comments/{{ $post->id }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::text('text', null, ['class' => 'form-inline', 'placeholder' => 'Add Comment']) }}
                                    {{ Form::submit('Add Comment', ['class' => 'btn btn-primary btn-sm']) }}
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <hr>

                @endforeach
            </ul>
        </div>
        @else 

        @endif
@endsection

