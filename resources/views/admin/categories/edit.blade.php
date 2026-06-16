@extends('layouts.admin')

@section('content')

    <h1>Edit Categories</h1>

    <div class="col-sm-6">
            
        
        <form method="POST" action="{{ route('admin.categories.update, $category->id') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            

            {{-- Title Field --}}
            <div class="form-group fw-bold mb-3">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
            </div>

            <button type="submit" class="btn btn-primary">
                Update Categories
            </button>

        </form>


    </div>
        
    <div class="col-sm-6">



    </div>


@stop