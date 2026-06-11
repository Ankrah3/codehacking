@extends('layouts.admin')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="text-center p-5 bg-white rounded shadow-sm" style="max-width: 500px;">
        <div class="mb-4 text-warning">
            <i class="fas fa-screwdriver-wrench" style="font-size: 4rem;"></i>
        </div>
        <h1 class="display-5 fw-bold text-dark">404 Workspace</h1>
        <h3 class="h5 text-secondary mb-3">Page Under Construction</h3>
        <p class="text-muted mb-4">
            This administration panel link is registered in your routing file, but its custom workspace view template hasn't been built yet.
        </p>
        <a href="{{ route('admin.index') }}" class="btn btn-primary btn-sm px-4 py-2 fw-semibold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Return to Dashboard
        </a>
    </div>
</div>
@endsection