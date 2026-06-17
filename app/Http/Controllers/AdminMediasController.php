<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $photos = Photo::all();

        return view('admin.medias.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //


        return view('admin.medias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Grab the file from Dropzone's request payload
        $file = $request->file('file');

        if ($file) {
            // FIX: Corrected string assignment and concatenation logic
            $name = time() . '_' . $file->getClientOriginalName();

            // 2. Move the file physically to public/images directory
            $file->move('images', $name);

            // 3. Save the string reference record to your Photos database table
            Photo::create(['file' => $name]);

            // Return a successful JSON response to let Dropzone know it succeeded
            return response()->json(['success' => $name]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // FIX 1: Remove the single quotes around $id so it parses as a variable
        $photo = Photo::findOrFail($id);

        // FIX 2: Add a clear slash spacer so the file path unlinks perfectly
        $filePath = public_path('images/' . $photo->file);

        // Only attempt to delete the file if it physically exists on your storage drive
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from your database
        $photo->delete();

        // Redirect the user back smoothly
        return redirect()->route('admin.medias.index');
    }
}
