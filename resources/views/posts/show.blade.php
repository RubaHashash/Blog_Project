@extends('layouts.index')

@section('content')
    <br>
    <a href="/posts" class="btn btn-default">Go Back</a>
    <br>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <hr>
    <small>Written on {{ $post->created_at }}</small>
    <hr>
    
    <a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a>

    <form method = 'POST', action="/posts/{{ $post->id }}", class="pull-right">
        @csrf
        @method('DELETE')
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    </form>
@endsection

