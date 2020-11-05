@extends('layouts.index')

@section('content')
    <br>
    <h1>{{ $post->title }}</h1>
    <hr>
    
    <div class="row">
        <div class="col-md-12">
            <img style="width: 30%" src="/storage/app/{{ $post->post_photo_path }}" alt="noimage">
        </div>
    </div>
    <br>
    <p>{{ $post->body }}</p>
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

