<x-app-layout>
    <x-tasks.task-layout>
        <x-tasks.title>Редактировать задачу: {{ $task->title }}</x-tasks.title>
        <x-forms.form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-forms.input name="title" label="Title" placeholder="Title" :value="old('title', $task->title)" />
            <x-forms.input name="body" label="Body" placeholder="Body" :value="old('body', $task->body)" />
            <x-forms.select name="status" label="Status"
                            :options="['in process' => 'In process', 'finished' => 'Finished', 'abandoned' => 'Abandoned']"
                            :selected="old('status', $task->status)" />
            <x-forms.select name="priority" label="Priority"
                            :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']"
                            :selected="old('priority', $task->priority)" />
            <x-forms.datetime name="deadline" label="Deadline" type="datetime-local"
                              :value="old('deadline', $task->deadline->format('Y-m-d\TH:i'))" />
            <x-forms.select name="categories[]" label="Categories" :options="$task->categories->pluck('name','id')->toArray()"
                            :selected="old('categories', $task->categories->pluck('id'))" multiple />
            <x-forms.select name="tags[]" label="Tags" :options="$task->tags->pluck('name','id')->toArray()"
                            :selected="old('tags', $task->tags->pluck('name','id'))" multiple />
            <x-forms.file name="path" label="Attached documents" />
            <div class="flex gap-4 mt-4">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow-sm">💾 Сохранить</button>
                <a href="{{ route('tasks.show', $task) }}" class="bg-yellow-200 text-yellow-900 px-4 py-2 rounded hover:bg-yellow-300 shadow-sm">⬅ Назад</a>
            </div>
        </x-forms.form>
    </x-tasks.task-layout>
</x-app-layout>
