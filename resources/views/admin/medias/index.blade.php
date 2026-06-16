@extends('layouts.admin')


@section('content')

    <h1>Media</h1>

    @if ($photos)
        
    <table class="table">
  <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Created</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($photos as $photo )
         <tr>
            <td>{{ $photo->id }}</td>
            <td><img height="50" src="{{ $photo->file }}"></td>
            <td>{{ $photo->created_at ? $photo->created_at : 'no date' }}</td>
            <td>

              <form action="{{ route('admin.medias.destroy', $photo->id) }}" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this media file?');">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>

              </form>


            </td>
        </tr>
    @endforeach

   
    
  </tbody>
</table>

@endif

@stop