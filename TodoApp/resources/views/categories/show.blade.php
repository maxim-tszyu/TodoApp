<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-900">
                Категория: {{ $cat->name }}
            </h1>
            <a href="{{ route('tasks.create', ['category' => $cat->id]) }}"
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 shadow-sm">
                ➕ Добавить задачу
            </a>
        </div>

        @if($tasks->isEmpty())
            <p class="text-green-800">В этой категории пока нет задач.</p>
        @else
            <div class="bg-green-50 border-2 border-green-200 shadow-md rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($tasks as $task)
                    <div class="bg-white rounded-lg shadow p-4">
                        <h2 class="text-xl font-semibold text-green-900 mb-2">
                            {{ $task->title }}
                        </h2>
                        <p class="text-green-700 mb-4">
                            {{ Str::limit($task->description, 100) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('tasks.show', $task->id) }}"
                               class="text-blue-600 hover:text-blue-800">
                                Подробнее →
                            </a>
                            <span class="text-sm text-green-600">
                                {{ $task->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('categories.index') }}"
               class="text-green-600 hover:text-green-800">
                ← Вернуться к списку категорий
            </a>
        </div>
    </div>
</x-app-layout>
