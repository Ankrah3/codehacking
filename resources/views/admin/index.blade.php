@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Admin Dashboard</h1>
    
    {{-- 1. Metrics & Statistics Grid --}}
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small text-uppercase fw-bold">Total Users</div>
                        <h2 class="display-6 fw-bold mb-0">12</h2> {{-- Placeholder number --}}
                    </div>
                    <i class="fas fa-users fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-black bg-opacity-10 border-0">
                    <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.users.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small text-uppercase fw-bold">Published Posts</div>
                        <h2 class="display-6 fw-bold mb-0">45</h2>
                    </div>
                    <i class="fas fa-file-lines fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-black bg-opacity-10 border-0">
                    <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.posts.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small text-uppercase fw-bold">Categories</div>
                        <h2 class="display-6 fw-bold mb-0">8</h2>
                    </div>
                    <i class="fas fa-tags fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-black bg-opacity-10 border-0">
                    <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.categories.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small text-uppercase fw-bold">Media Library</div>
                        <h2 class="display-6 fw-bold mb-0">24</h2>
                    </div>
                    <i class="fas fa-photo-film fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-black bg-opacity-10 border-0">
                    <a class="small text-white stretched-link text-decoration-none" href="{{ route('admin.medias.index') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Recent Application Activity Row --}}
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light border-0 py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-desktop me-2 text-primary"></i>System Overview</h5>
                </div>
                <div class="card-body py-4">
                    <h4 class="text-primary">Welcome to CodeHacking Administration!</h4>
                    <p class="text-muted fs-6">
                        From this panel, you can seamlessly moderate registered system users, publish technical content blog articles, create hierarchical categories, and oversee dropped dropzone media assets.
                    </p>
                    <hr class="my-4 text-black-50">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Write New Post
                        </a>
                        <a href="{{ route('admin.medias.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-upload me-1"></i> Upload Assets
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-light border-0 py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bolt me-2 text-warning"></i>Quick Management</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action py-3">
                        <i class="fas fa-user-plus text-primary me-3"></i>Create System User
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action py-3">
                        <i class="fas fa-folder-plus text-success me-3"></i>Manage Categories
                    </a>
                    <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action py-3">
                        <i class="fas fa-comments text-info me-3"></i>Review Comments Section
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection