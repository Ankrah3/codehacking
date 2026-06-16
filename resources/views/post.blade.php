{{-- Leave a Comment Submission Form (Open to Everyone) --}}
<div class="card my-4 shadow-sm border-0">
    <h5 class="card-header bg-primary text-white py-3 fw-bold">Leave a Comment:</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.comments.store') }}">
            @csrf
            
            {{-- Hidden input to pass the current post ID automatically --}}
            <input type="hidden" name="post_id" value="{{ $post->id }}">

            @if(Auth::check())
                {{-- If logged in, let them know we are using their account profile --}}
                <p class="text-muted mb-3">Logged in as: <strong class="text-dark">{{ Auth::user()->name }}</strong></p>
            @else
                {{-- If they are a guest visitor, show Name and Email fields --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label fw-bold text-muted">Your Name:</label>
                        <input type="text" name="author" id="author" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold text-muted">Your Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="body" class="form-label fw-bold text-muted">Message:</label>
                <textarea name="body" id="body" class="form-control" rows="3" required placeholder="Type your comment here..."></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Submit Comment
            </button>
        </form>
    </div>
</div>