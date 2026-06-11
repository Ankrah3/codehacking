<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $users = User::all();

        return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        //

        if (trim($request->password) == '') {

            $input = $request->except('password');

        } else {

            $input = $request->all();


        }



        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id;


        }



        $input['password'] = bcrypt($request->password);

        User::create($input);


        return redirect('/admin/users');

        // return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersEditRequest $request, string $id)
    {
        //

        $user = User::findOrFail($id);

        // Explicitly check if a password was actually typed in
        if (trim($request->password) == '') {

            $input = $request->except('password');

        } else {

            $input = $request->all();

        }

        // Handle photo upload if a new file is chosen
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }


        $input['password'] = bcrypt($request->password);

        // Now Eloquent will only update fields that exist inside $input
        $user->update($input);

        return redirect('/admin/users');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
