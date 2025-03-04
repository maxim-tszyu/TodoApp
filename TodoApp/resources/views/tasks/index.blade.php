<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-6 text-yellow-900">Задачи</h1>

            <div class="mb-4 text-right">
                <a href="{{ route('tasks.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow-sm">
                    ➕ Добавить задачу
                </a>
        </div>
        </div>

        <div class="bg-yellow-50 border-2 border-yellow-200 shadow-md rounded-lg p-6">
            @forelse ($tasks as $task)
                <div class="mb-4 border-b border-yellow-200 pb-4">
                    <h2 class="text-xl font-semibold text-yellow-900 mb-1">
                        <a href="{{ route('tasks.show', $task) }}" class="hover:underline">{{ $task->title }}</a>
                    </h2>
                    <p class="text-yellow-800 mb-1">Автор: {{ $task->user->name }}</p>
                    <p class="text-yellow-800 mb-1">Дедлайн: {{ $task->deadline->format('d.m.Y H:i') }}</p>

                    <div class="flex items-center gap-2 mt-2">
                        <a href="{{ route('tasks.show', $task) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 shadow-sm">👁 Просмотр</a>
                        <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 shadow-sm">✏ Редактировать</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 shadow-sm">🗑 Удалить</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-yellow-800">Задач пока нет.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
