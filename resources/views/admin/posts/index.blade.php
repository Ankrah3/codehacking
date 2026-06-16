@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Photo</th>
                <th scope="col">Photo</th>
                <th scope="col">Owner</th>
                <th scope="col">Category</th>    
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
            </tr>
        </thead>
        <tbody>

            @if($posts)


                @foreach ($posts as $post )
                                   
            <tr>
                <td>{{ $post->id }}</td>
                <td><img height="50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.co/100x100'}}" alt=""></td>
                <td><a href="{{ route('admin.posts.edit', $post->id) }}"> {{ $post->user->name }}</a></td>
                <td>{{ $post->category ? $post->category->name : 'Uncategorised'}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ str($post->body)->limit(30) }}</td>
                <td>{{ $post->created_at->diffForhumans() }}</td>
                <td>{{ $post->updated_at->diffForhumans() }}</td>
            </tr>

            @endforeach

            @endif

        </tbody>
    </table>
    
@endsection

