<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Post::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();
        return view('tasks.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'required|integer|exists:tags,id',
        ]);
        $task = Post::create([
            'user_id' => Auth::id(),
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'status' => $attributes['status'],
            'priority' => $attributes['priority'],
            'deadline' => $attributes['deadline'],
        ]);
        $task->tags()->sync($request->tags);
        $task->categories()->sync($request->categories);
        $filePath = $request->file('path')->store('files', 's3');
        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $task)
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();

        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated_data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'required|integer|exists:tags,id',
        ]);
        $post->update($validated_data);
        if($request->get('tags')){
            $post->tags()->sync($request->get('tags'));
        }
        if($request->get('categories')){
            $post->categories()->sync($request->get('categories'));
        }
        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
