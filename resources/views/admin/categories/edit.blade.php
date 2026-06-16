@extends('layouts.admin')

@section('content')

    <h1>Edit Category</h1>

    <div class="row">
        <div class="col-sm-6">
            
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PATCH')

                {{-- Name Field --}}
                <div class="form-group fw-bold mb-3">
                    <label for="name">Name:</label>
                    {{-- FIX: Added name="name" attribute --}}
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control" 
                        value="{{ old('name', $category->name) }}"
                    >
                </div>

                {{-- Side-by-Side Action Buttons Container --}}
                <div class="d-flex gap-2 mb-3">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="fas fa-floppy-disk me-2"></i>Update Category
                    </button>
            </form>

                    {{-- Separate Delete Form tucked inside the flex layout wrapper --}}
                    <form method="POST" 
                          action="{{ route('admin.categories.destroy', $category->id) }}" 
                          onsubmit="return confirm('Are you sure you want to permanently delete this category?');">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash-can me-2"></i>Delete Category
                        </button>
                    </form>
                </div>

        </div>

        {{-- Right Column (Empty placeholder for spacing or future metadata layouts) --}}
        <div class="col-sm-6">
            {{-- Leave blank or add error files if necessary --}}
        </div>
    </div>

@endsection