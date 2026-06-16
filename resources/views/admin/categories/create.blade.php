@extends('layouts.admin')

@section('content')

    <h1 class="mb-4"><i class="fas fa-plus-circle text-primary me-2"></i>Create Category</h1>
    
    <div class="row">
        <div class="col-md-6">

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                {{-- Category Name Field --}}
                <div class="form-group fw-bold mb-3">
                    <label for="name" class="form-label">Category Name:</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control" 
                           placeholder="e.g., Python, Vue.js" 
                           required>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-folder-plus me-1"></i> Create Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

    {{-- Error Handling Row --}}
    <div class="row mt-3">
        <div class="col-md-6">
            @include('includes.form_error') 
        </div>
    </div>

@endsection