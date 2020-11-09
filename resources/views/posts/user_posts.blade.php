@extends('layouts.index')

@section('content')
    <br>
    <h1>My Posts</h1>
    <hr>
    
    @if (count($posts)>0)
        
        <table class="table table-striped" style="width: 50%; margin-left:25%">
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>

            @foreach ($posts as $post)
                <tr>
                    <th><img style="width: 25%; margin-right:15px" src="/storage/app/{{ $post->post_photo_path }}" alt="noimage"> {{ $post->title }}</th>
                    
                    <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-default">Edit</a></th>
                    
                    <th>
                        <form method = 'POST', action="/posts/{{ $post->id }}">
                            @csrf
                            @method('DELETE')
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                        </form>
                    </th>
                    
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

