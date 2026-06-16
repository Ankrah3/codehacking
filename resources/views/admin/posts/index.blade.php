@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    
    <table class="table align-middle">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Photo</th> {{-- Removed the duplicate header row --}}
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
            @foreach ($posts as $post)                               
                <tr>
                    <td>{{ $post->id }}</td>
                    {{-- FIX: Added the asset folder helper for image rendering --}}
                    <td>
    <img height="50" width="100" class="rounded img-thumbnail" 
         src="{{ $post->photo ? asset($post->photo->file) : 'https://placehold.co/100x100' }}" 
         alt="Featured Image">
</td>
                    <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->user->name }}</a></td>
                    <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->body, 30) }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
    
@endsection

