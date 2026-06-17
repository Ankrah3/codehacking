@extends('layouts.admin')

@section('content')

    <h1>Create Users</h1>

    <div class="row">
        <div class="col-sm-10">
            {{-- Added novalidate so Laravel's form_error template can actually display --}}
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name:</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label fw-bold">Role:</label>
                    <select name="role_id" id="role_id" class="form-select" required>
                        <option value="" disabled selected>Choose Options</option>
                        @foreach($roles as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label fw-bold">Status:</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="0" selected>Not Active</option>
                        <option value="1">Active</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo_id" class="form-label fw-bold">Photo:</label> 
                    <input
                        type="file"
                        name="photo_id"
                        id="photo_id"
                        class="form-control"
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password:</label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control password-field"
                            required
                        >
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Create User
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('#password');
            const toggleButton = document.querySelector('.toggle-password');
            const icon = toggleButton.querySelector('i');

            toggleButton.addEventListener('click', function () {
                // Toggle the HTML type attribute
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    
                    // Switch icon to "eye-slash" if you are using Bootstrap Icons
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    
                    // Switch back to regular eye icon
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    </script>
@stop

