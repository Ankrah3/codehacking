@extends('layouts.admin')


@section('content')

    <h1>Categories</h1>
    <div class="row">
        <div class="col-sm-6">
            
        
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                

                {{-- Title Field --}}
                <div class="form-group fw-bold mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Categories
                </button>

            </form>


        </div> 



        <div class="col-sm-6">


            @if ($categories)
                        
                    

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            
                    

                            <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

            @endif
            
        </div>
    
    </div>

@stop