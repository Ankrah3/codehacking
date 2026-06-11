@extends('layouts.admin')

@section('content')

    <h1>Edit User</h1>

    <div class="row align-items-start">

        <div class="col-sm-2">
            <img src="{{ $user->photo ? $user->photo->file : 'https://placehold.co/400x400' }}" alt="User Photo" class="img-fluid img-thumbnail w-100">
        </div>

        <div class="col-sm-10">
            <form method="POST"
                action="{{ route('admin.users.update', $user->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name:</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email:</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label fw-bold">Role:</label>
                    <select name="role_id" id="role_id" class="form-select">
                        @foreach($roles as $id => $name)
                            <option value="{{ $id }}"
                                {{ old('role_id', $user->role_id) == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label fw-bold">Status:</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="0"
                            {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                            Not Active
                        </option>
                        <option value="1"
                            {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                            Active
                        </option>
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
                        >
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update User
                </button>

            </form>
        </div>

    </div>

@include('includes.form_error')

@stop