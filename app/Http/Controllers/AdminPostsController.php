<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Optimization: Eager load relations to prevent N+1 memory issues in your table view
        $posts = Post::with(['user', 'category', 'photo'])->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file('photo_id')) {
            $name = time() . '_' . $file->getClientOriginalName();

            // FIX: Wrap the destination directory inside the public_path helper!
            $file->move(public_path('images'), $name);

            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function post($id)
    {
        // Find the specific post or fail with a 404 screen if the ID doesn't exist
        $post = Post::findOrFail($id);

        // Load the fresh post.blade.php view file we created, injecting our $post variable
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the post globally, regardless of who originally authored it
        $post = Post::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('photo_id')) {
            $name = time() . '_' . $file->getClientOriginalName();

            // FIX: Wrap the destination directory inside the public_path helper!
            $file->move(public_path('images'), $name);

            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;

            if ($post->photo) {
                $oldFile = public_path('images/' . $post->photo->file);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        }

        // FIX: Update directly against the post object
        $post->update($input);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // FIX: Safe directory path concatenation for unlinking files
        if ($post->photo) {
            $filePath = public_path('images/' . $post->photo->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $post->delete();

        Session::flash('deleted_post', 'The post has been deleted');

        return redirect()->route('admin.posts.index');
    }
}
