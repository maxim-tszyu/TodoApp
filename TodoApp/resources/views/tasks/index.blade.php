<x-app-layout>
    <div class="container mx-auto p-6 space-y-8">

        <div class="flex justify-between items-center mb-6 bg-yellow-100 p-4 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-yellow-900 flex items-center gap-2">
                🗂️ Мои задачи
            </h1>
            <a href="{{ route('tasks.create') }}"
               class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-lg hover:scale-105 transition-transform shadow-md">
                ➕ Добавить задачу
            </a>
        </div>

        <div class="flex justify-between items-center bg-yellow-50 p-4 rounded-lg shadow-sm">
            <input type="text" placeholder="🔍 Поиск задач..."
                   class="border border-yellow-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 w-1/2">
            <select
                class="border border-yellow-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="all">Все</option>
                <option value="important">Важные</option>
                <option value="done">Выполненные</option>
                <option value="in_progress">В процессе</option>
                <option value="overdue">Просроченные</option>
            </select>
        </div>

        <div class="bg-yellow-50 border-2 border-yellow-200 shadow-md rounded-lg p-6 space-y-6">

            <h2 class="text-2xl font-semibold text-yellow-900 border-b pb-2 mb-4">🔥 Важные задачи</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($tasks->where('priority', 'high') as $task)
                    <div
                        class="bg-white border border-yellow-200 shadow-md rounded-lg p-4 hover:bg-yellow-100 transition">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-gray-500 flex items-center gap-1">
                                🗓️ {{ $task->created_at->format('d M Y') }}
                            </span>
                            <span class="{{
                                $task->status == 'finished' ? 'bg-green-100 text-green-800' :
                                ($task->status == 'in process' ? 'bg-blue-100 text-blue-800' :
                                ($task->status == 'abandoned' ? 'bg-gray-100 text-gray-800' :
                                'bg-red-100 text-red-800')) }}">
                                {{
                                    $task->status == 'finished' ? 'Завершена' :
                                    ($task->status == 'in process' ? 'В процессе' :
                                    ($task->status == 'abandoned' ? 'Заброшена' :
                                    'Не начата'))
                                }}
                            </span>
                        </div>
                        <h2 class="text-lg font-semibold mb-2 text-yellow-900">{{ $task->title }}</h2>
                        <p class="text-sm text-gray-600 mb-4">{{ $task->description }}</p>

                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($task->tags as $tag)
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">#{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        @if($task->status == 'in_progress')
                            <div class="w-full bg-yellow-200 rounded-full h-2.5 mb-4">
                                <div class="bg-yellow-500 h-2.5 rounded-full"
                                     style="width: {{ $task->progress ?? 50 }}%"></div>
                            </div>
                        @endif

                        <div class="flex justify-between items-center">
                            <span class="text-xs text-yellow-800">
                                Важность:
                                @if ($task->priority === 'low')
                                    ⭐
                                @elseif ($task->priority === 'medium')
                                    ⭐⭐
                                @elseif ($task->priority === 'high')
                                    ⭐⭐⭐
                                @endif
                            </span>
                            <a href="{{ route('tasks.show', $task->id) }}"
                               class="text-xs text-yellow-600 hover:underline">
                                Подробнее →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-yellow-800">Важных задач пока нет.</p>
                @endforelse
            </div>

            <h2 class="text-2xl font-semibold text-yellow-900 border-b pb-2 mb-4 mt-8">📋 Все задачи</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($tasks as $task)
                    <x-tasks.card :task="$task"/>
                @empty
                    <p class="text-yellow-800">Задач пока нет.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
