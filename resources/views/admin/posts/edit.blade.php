@extends('layouts.admin')

@section('content')

    <h1>Edit Post</h1>
    
    <div class="row">

        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Title Field --}}
            <div class="form-group fw-bold mb-3">
                <label for="title" class="form-label fw-bold">Title:</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-control"
                    value="{{ old('title', $post->title) }}"
                >
            </div>

            {{-- Category Dropdown --}}
            <div class="form-group fw-bold mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Choose Categories</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" {{ $post->category_id == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

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
                <textarea name="body" id="body" rows="5" class="form-control" placeholder="Enter description">{{ old('body', $post->body) }}</textarea>
            </div>

            {{-- Flexbox Button Row container --}}
            <div class="d-flex gap-2 mb-3">
                <button type="submit" class="btn btn-primary flex-fill">
                   <i class="fas fa-floppy-disk me-2"></i> Update Post
                </button>
        </form>

                {{-- Separate Delete Form tucked inside the flex layout wrapper --}}
                <form method="POST"
                      action="{{ route('admin.posts.destroy', $post->id) }}"
                      class="flex-fill"
                      onsubmit="return confirm('Are you sure you want to permanently delete this post?');"> {{-- Note: Fixed text prompt to say 'post' instead of 'user' --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash-can me-2"></i>Delete Post
                    </button>
                </form>
            </div>

    </div>

    <div class="row">
        @include('includes.form_error') 
    </div>

@endsection