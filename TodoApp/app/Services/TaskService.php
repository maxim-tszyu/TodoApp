<?php

namespace App\Services;

use App\Events\TaskRemindedEvent;
use App\DTO\CreateTaskDTO;
use App\Models\Task;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public function create(CreateTaskDTO $dto) {
        $task = Task::create([
            'user_id' => $dto->userId,
            'title' => $dto->title,
            'body' => $dto->body,
            'priority' => $dto->priority,
            'deadline' => $dto->deadline,
        ]);

        event(new TaskRemindedEvent($task));

        $this->syncRelations($task, $dto, 'tags', 'categories');

        if ($dto->path) {
            $fileName = $dto->path->getClientOriginalName();
            $safeFilePath = str_replace(' ', '-', $task->title . '/' . $fileName);
            $filePath = $dto->path->store(
                'tasks/' . $task->user_id . '/' . $safeFilePath,
                'attachments'
            );
            $task->update(['path' => $filePath]);
        }
    }
    public function update(CreateTaskDTO $dto,  Task $task) {
        $task->tags()->detach();
        $task->categories()->detach();
        $task->update([
            'title' => $dto->title,
            'body' => $dto->body,
            'priority' => $dto->priority,
            'deadline' => $dto->deadline,
        ]);
        if ($dto->tags) {
            $task->tags()->sync($dto->tags);
        }
        if ($dto->categories) {
            $task->categories()->sync($dto->categories);
        }
        if ($dto->path) {
            if ($task->path && Storage::disk('attachments')->exists($task->path)) {
                Storage::disk('attachments')->delete($task->path);
            }
            $this->handleFileUpload($task, $dto->path);
        }
    }
    public function syncRelations(Task $task, CreateTaskDTO $dto, ...$relations) {
        foreach ($relations as $relation) {
            if (property_exists($dto, $relation) && !is_null($dto->$relation)) {
                $task->$relation()->sync($dto->$relation);
            }
        }
    }
    public function handleFileUpload(Task $task, UploadedFile $file) {
        if (!$file) {
            return;
        }
        $fileName = $file->getClientOriginalName();
        $safeFilePath = str_replace(' ', '-', $task->title . '/' . $fileName);
        $filePath = $file->store(
            'tasks/' . $task->user_id . '/' . $safeFilePath,
            'attachments'
        );

        $task->update(['path' => $filePath]);
    }
}
