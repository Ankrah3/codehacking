<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::all();



        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Base validation requirements for all submittals
        $rules = [
            'post_id' => 'required|integer',
            'body'    => 'required|string|max:1000'
        ];

        // 2. If it's a guest visitor, require them to fill out the author name and email fields
        if (!auth()->check()) {
            $rules['author'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
        }

        $request->validate($rules);

        // 3. Populate data depending on login status
        if (auth()->check()) {
            $user = auth()->user();
            $authorName = $user->name;
            $authorEmail = $user->email;
        } else {
            $authorName = $request->author;
            $authorEmail = $request->email;
        }

        // 4. Build payload matrix mapping straight to database columns
        $data = [
            'post_id'   => $request->post_id,
            'author'    => $authorName,
            'email'     => $authorEmail,
            'body'      => $request->body,
            'is_active' => 0 // Kept at 0 so guest spam won't display instantly without approval!
        ];

        \App\Models\Comment::create($data);

        return redirect()->back()->with('comment_message', 'Your comment has been submitted and is awaiting moderation approval!');
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
        //

        $comment = Comment::findOrFail($id);
        $comment->delete();


        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully');

    }
}
