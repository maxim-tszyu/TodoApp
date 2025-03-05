<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();
        return view('tasks.create', compact('categories', 'tags'));
    }
    public function store(TaskRequest $request)
    {
        $attributes = $request->validated();
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'status' => $attributes['status'],
            'priority' => $attributes['priority'],
            'deadline' => $attributes['deadline'],
        ]);
        if(isset($attributes['tags'])) {
            $task->tags()->sync($attributes['tags']);
        }
        if(isset($attributes['categories'])){
            $task->categories()->sync($attributes['categories']);
        }
        if(isset($attributes['file'])) {
            $filePath = $attributes['path']->store('files', 's3');
        }
        return redirect(route('tasks.index'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
    public function edit(Task $task)
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();

        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $validated_data = $request->validated();
        $task->tags()->detach();
        $task->categories()->detach();

        $task->update($validated_data);
        if($request->get('tags')){
            $task->tags()->sync($request->get('tags'));
        }
        if($request->get('categories')){
            $task->categories()->sync($request->get('categories'));
        }
        return redirect(route('tasks.index'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
