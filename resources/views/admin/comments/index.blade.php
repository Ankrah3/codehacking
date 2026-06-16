@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Manage Comments</h1>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-light border-0 py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-comments me-2 text-primary"></i>All Post Comments</h5>
        </div>
        <div class="card-body">
            
            @if(count($comments) > 0)
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Post</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->body }}</td>
                                
                                {{-- Link back to view the specific post associated with the comment --}}
                                <td>
                                    <a href="{{ route('admin.posts.show', $comment->post_id) }}" class="text-decoration-none">
                                        {{ $comment->post ? $comment->post->title : 'View Post' }}
                                    </a>
                                </td>
                                
                                <td>{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'No date' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        {{-- Toggle Approve / Unapprove Button based on status database flag --}}
                                        @if($comment->is_active == 1)
                                            <button class="btn btn-warning btn-sm">Unapprove</button>
                                        @else
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        @endif
                                        
                                        {{-- Delete Form Wrapper --}}
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                {{-- Fallback UI UI state when database comments table has 0 records --}}
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-comment-slash fa-3x mb-3"></i>
                    <p class="fs-5 mb-0">No comments found in the database directory.</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection