<?php

namespace App\DTO;

use App\Http\Requests\TaskRequest;

class CreateTaskDTO
{
    public function __construct(
        public string $title,
        public string $body,
        public string $priority,
        public string $deadline,
        public ?array $tags,
        public ?array $categories,
        public ?\Illuminate\Http\UploadedFile $path,
        public int $userId,
    )
    {
    }
    public static function fromRequest(TaskRequest $request)
    {
        $validated  = $request->validated();
        return new self(
            title: $validated['title'],
            body: $validated['body'],
            priority: $validated['priority'],
            deadline: $validated['deadline'],
            tags: $validated['tags'] ?? null,
            categories: $validated['categories'] ?? null,
            path: $request->file('path'),
            userId: $request->user()->id,
        );
    }
}
