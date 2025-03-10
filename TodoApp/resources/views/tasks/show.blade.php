<x-app-layout>
    <x-tasks.task-layout>
        <x-tasks.title>{{ $task->title }}</x-tasks.title>
        <p class="text-yellow-800 mb-2">👤 Автор: {{ $task->user->name }}</p>
        <p class="text-yellow-800 mb-2">📅 Дата создания: {{ $task->created_at->format('d.m.Y H:i') }}</p>
        <p class="text-yellow-800 mb-4">🗓 Дедлайн: {{ $task->deadline->format('d.m.Y H:i') }}</p>

        <div class="flex items-center mb-4">
            <span class="text-sm font-semibold mr-2 text-yellow-900">📊 Статус:</span>
            <span class="px-2 py-1 rounded-full text-white shadow-sm
                @if($task->status === 'in process') bg-blue-500
                @elseif($task->status === 'finished') bg-green-500
                @else bg-red-500 @endif">
                {{ ucfirst($task->status) }}
            </span>
        </div>

        <div class="flex items-center mb-4">
            <span class="text-sm font-semibold mr-2 text-yellow-900">⚡ Приоритет:</span>
            <span class="px-2 py-1 rounded-full text-white shadow-sm
                @if($task->priority === 'low') bg-green-500
                @elseif($task->priority === 'medium') bg-yellow-500
                @else bg-red-500 @endif">
                {{ ucfirst($task->priority) }}
            </span>
        </div>

        <x-tasks.listing :field="$task->categories" title="📂 Категории"></x-tasks.listing>

        <x-tasks.listing :field="$task->tags" title="🏷 Тэги"></x-tasks.listing>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2 text-yellow-900">📝 Описание:</h2>
            <div class="bg-yellow-100 p-4 rounded shadow-sm">
                <p class="text-yellow-900 leading-relaxed whitespace-pre-wrap">{{ $task->body }}</p>
            </div>
        </div>

        @if($task->path)
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2 text-yellow-900">📁 Файл:</h2>
                <a href="{{ asset('storage/' . $task->path) }}" target="_blank" class="text-blue-600 hover:underline transition">
                    📥 Скачать файл
                </a>
            </div>
        @endif

        <div class="flex justify-between mt-6">
            <a href="{{ route('tasks.index') }}"
               class="bg-yellow-200 text-yellow-900 px-4 py-2 rounded hover:bg-yellow-300 shadow-sm transition">
                ⬅ Назад
            </a>
            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow-sm transition">
                    ✏ Редактировать
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('Точно удалить?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 shadow-sm transition">
                        🗑 Удалить
                    </button>
                </form>
            </div>
        </div>
    </x-tasks.task-layout>
</x-app-layout>
