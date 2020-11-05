
@extends('layouts.index')

@section('content')

    <h1>Create Post</h1>

    {{-- {!! Form::open(['action' => 'store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['classes' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    {!! Form::close() !!} --}}

    <form method="POST" action="/posts">
        @csrf
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body', 'required']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div>
    </form>

@endsection

