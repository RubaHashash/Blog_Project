@extends('layouts.index')

@section('content')
    <br>
    <h1>My Posts</h1>
    <hr>
    
    @if (count($posts)>0)
        
        <table class="table table-striped">
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <th>{{ $post->title }}</th>
                    <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a></th>
                    <th></th>
                </tr>
            @endforeach
        </table>
    
    @else 
        <p>You have no posts.</p>
    @endif

    <form method="POST" action="/posts/create" , class="pull-right">
        @csrf
        <div class="form-group">
            {{ Form::submit('Add New Post', ['class' => 'btn btn-primary']) }}
        </div>
    </form>

@endsection

