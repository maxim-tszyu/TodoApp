<?php

namespace App\Http\Controllers;

use App\Events\TaskRemindedEvent;
use App\DTO\CreateTaskDTO;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use App\Services\TaskService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private TaskService $taskService
    ){
    }

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
        $dto = CreateTaskDTO::fromRequest($request);
        $this->taskService->create($dto);
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
        $dto = CreateTaskDTO::fromRequest($request);
        $this->taskService->update($dto, $task);
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
