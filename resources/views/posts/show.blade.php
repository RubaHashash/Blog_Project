@extends('layouts.index')

@section('content')
    <br>
    <a href="/posts" class="btn btn-default">Go Back</a>
    <br>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <hr>
    <small>Written on {{ $post->created_at }}</small>

        
@endsection

