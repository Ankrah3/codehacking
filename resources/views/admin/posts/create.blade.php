@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    
    <div class="row">

        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            

            {{-- Title Field --}}
            <div class="form-group fw-bold mb-3">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
            </div>

            {{-- Category Dropdown --}}
            <select name="category_id" id="category_id" class="form-control">
    <option value="">Choose Categories</option>

    @foreach($categories as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
    @endforeach
</select>

            {{-- Photo Upload Field --}}
            <div class="mb-3">
                        <label for="photo_id" class="form-label fw-bold">Photo:</label> 
                        <input
                            type="file"
                            name="photo_id"
                            id="photo_id"
                            class="form-control"
                        >
                    </div>

            {{-- Description Textarea --}}
            <div class="form-group fw-bold mb-3">
                <label for="body">Description:</label>
                <textarea name="body" id="body" rows="5" class="form-control" placeholder="Enter description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Create Post
            </button>

        </form>

    </div>

    <div class="row">
        @include('includes.form_error') 
    </div>

    

@endsection