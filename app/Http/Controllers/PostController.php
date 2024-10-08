<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_published' => 'boolean',
            'status' => 'string',
        ]);

        DB::beginTransaction();

        try {
            Auth::user()->posts()->create($validated);

            DB::commit();

            notify()->success('Created successfully.');
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
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
    public function edit(Post $post)
    {
        $category = $post->categories();
        return view('posts.edit', compact(['post', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'string',
            'is_published' => 'boolean',
        ]);

        $isPublished = $request->is_published;

        // dd($isPublished);

        DB::beginTransaction();

        try {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'is_published' => $isPublished,
            ]);

            DB::commit();

            notify()->success('Updated successfully.');
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            notify()->success('Deleted successfully.');
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
