<x-app-layout>
    <x-tasks.task-layout>
        <x-tasks.title>Редактировать задачу: {{ $task->title }}</x-tasks.title>
        <x-forms.form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-forms.input name="title" label="Заголовок" placeholder="Введите заголовок" :value="old('title', $task->title)" class="mb-4" />

            <x-forms.input name="body" label="Описание" placeholder="Введите описание задачи" :value="old('body', $task->body)" class="mb-4" />

            <x-forms.select name="priority" label="Приоритет"
                            :options="['low' => 'Низкий', 'medium' => 'Средний', 'high' => 'Высокий']"
                            :selected="old('priority', $task->priority)" class="mb-4" />

            <x-forms.datetime name="deadline" label="Дедлайн" type="datetime-local"
                              :value="old('deadline', $task->deadline->format('Y-m-d\TH:i'))" class="mb-4" />

            <x-forms.select name="categories[]" label="Категории" :options="$categories->pluck('name','id')->toArray()"
                            :selected="old('categories', $task->categories->pluck('id'))" multiple class="mb-4"/>

            <x-forms.select name="tags[]" label="Тэги" :options="$tags->pluck('name','id')->toArray()"
                            :selected="old('tags', $task->tags->pluck('id'))" multiple class="mb-4"/>

            <x-forms.file name="path" label="Прикрепить документы" class="mb-4" />

            <div class="flex gap-4 mt-6">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow-sm transition">
                    💾 Сохранить
                </button>
                <a href="{{ route('tasks.show', $task) }}"
                   class="bg-yellow-200 text-yellow-900 px-4 py-2 rounded hover:bg-yellow-300 shadow-sm transition">⬅ Назад</a>
            </div>
        </x-forms.form>
    </x-tasks.task-layout>
</x-app-layout>
