<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);

        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();
        return view('tasks.create', compact('categories', 'tags'));
    }

    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $attributes = $request->validated();
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'priority' => $attributes['priority'],
            'deadline' => $attributes['deadline'],
        ]);
        if (isset($attributes['tags'])) {
            $task->tags()->sync($attributes['tags']);
        }
        if (isset($attributes['categories'])) {
            $task->categories()->sync($attributes['categories']);
        }
        if ($request->hasFile('path')) {
            $fileName = $request->path->getClientOriginalName();
            $safeFilePath = str_replace(' ', '-', $task->title.'/'.$fileName);
            $filePath = $request->file('path')->store('tasks/'.$task->user_id.'/'.$safeFilePath, 'attachments');
            $task->update(['path' => $filePath]);
        }
        return redirect(route('tasks.index'));
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();

        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated_data = $request->validated();
        $task->tags()->detach();
        $task->categories()->detach();

        $task->update(collect($validated_data)->except(['tags', 'categories'])->toArray());
        if ($request->get('tags')) {
            $task->tags()->sync($request->get('tags'));
        }
        if ($request->get('categories')) {
            $task->categories()->sync($request->get('categories'));
        }
        if ($request->hasFile('path')) {
            if ($task->path && Storage::disk('attachments')->exists($task->path)) {
                Storage::disk('attachments')->delete($task->path);
            }
            $fileName = $request->path->getClientOriginalName();
            $safeFilePath = str_replace(' ', '-', $task->title.'/'.$fileName);
            $filePath = $request->file('path')->store('tasks/'.$task->user_id.'/'.$safeFilePath, 'attachments');
            $task->update(['path' => $filePath]);
        }
        return redirect(route('tasks.index'));
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        if ($task->path && Storage::disk('attachments')->exists($task->path)) {
            Storage::disk('attachments')->delete($task->path);
        }
        $task->delete();
        return redirect(route('tasks.index'));
    }
}
