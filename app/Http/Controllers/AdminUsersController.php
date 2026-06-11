<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        // 1. Capture request values safely
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            // DO NOT use bcrypt() here! Laravel 12's Model Cast handles it natively.
            $input['password'] = $request->password;
        }

        // 2. Handle Photo Upload
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        User::create($input);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersEditRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        // 1. Safely handle whether a new password was provided or left blank
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            // DO NOT use bcrypt() here! Laravel 12's Model Cast handles it natively.
            $input['password'] = $request->password;
        }

        // 2. Handle new Photo Upload if selected
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        // 3. Update execution
        $user->update($input);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        unlink(public_path() . $user->photo->file); // Delete the photo file from the server
        $user->delete(); // Delete the user record from the database

        Session::flash('deleted_user', 'The user has been deleted');

        return redirect('/admin/users');
    }
}
