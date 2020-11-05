
@extends('layouts.index')

@section('content')

    <h1>Edit Post</h1>

    <form method="POST" action="/posts/{{ $post->id }}", enctype = "multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::file('image') }}
        </div>

        <div class="form-group">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div>
    </form>

@endsection

