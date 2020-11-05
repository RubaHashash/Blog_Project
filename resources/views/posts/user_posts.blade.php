@extends('layouts.index')

@section('content')
    <h1>My Posts</h1>

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

@endsection

