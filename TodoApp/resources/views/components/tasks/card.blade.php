@props(['task'])
@php
    $priorityColors = match($task->priority) {
        'high' => ['bg' => 'bg-red-100', 'border' => 'border-red-500', 'text' => 'text-red-700', 'icon' => '⚠️'],
        'medium' => ['bg' => 'bg-orange-100', 'border' => 'border-orange-500', 'text' => 'text-orange-700', 'icon' => '⚖️'],
        'low' => ['bg' => 'bg-green-100', 'border' => 'border-green-500', 'text' => 'text-green-700', 'icon' => '✅'],
        default => ['bg' => 'bg-gray-100', 'border' => 'border-gray-500', 'text' => 'text-gray-700', 'icon' => '❓'],
    };
@endphp

<div class="mb-6 w-full">
    <div class="{{ $priorityColors['bg'] }} {{ $priorityColors['border'] }} rounded-lg p-6 shadow-lg hover:shadow-2xl transition-shadow overflow-hidden">
        <h2 class="text-2xl font-bold {{ $priorityColors['text'] }} mb-2 flex items-center gap-2">
            {{ $priorityColors['icon'] }} <a href="{{ route('tasks.show', $task) }}" class="hover:underline">{{ $task->title }}</a>
        </h2>
        <p class="{{ $priorityColors['text'] }} mb-2">👤 Автор: <span class="font-semibold">{{ $task->user->name }}</span></p>
        <p class="{{ $priorityColors['text'] }} mb-2">📅 Дедлайн: <span class="font-semibold">{{ $task->deadline->format('d.m.Y H:i') }}</span></p>

        <div class="mb-2">
            <p class="{{ $priorityColors['text'] }} mb-1 font-semibold">📂 Категории:</p>
            <div class="flex gap-2 flex-wrap">
                @forelse($task->categories as $category)
                    <span class="bg-blue-200 text-blue-900 px-2 py-1 rounded-full text-sm shadow-sm hover:bg-blue-300 transition">
                        {{ $category->name }}
                    </span>
                @empty
                    <span class="text-gray-500">Без категории</span>
                @endforelse
            </div>
        </div>

        <div class="mb-2">
            <p class="{{ $priorityColors['text'] }} mb-1 font-semibold">🏷 Теги:</p>
            <div class="flex gap-2 flex-wrap">
                @forelse($task->tags as $tag)
                    <span class="bg-yellow-300 text-yellow-900 px-2 py-1 rounded-full text-sm shadow-sm hover:bg-yellow-400 transition">
                        #{{ $tag->name }}
                    </span>
                @empty
                    <span class="text-gray-500">Отсутствуют</span>
                @endforelse
            </div>
        </div>

        <div class="flex items-center gap-2 mt-4 flex-wrap">
            <a href="{{ route('tasks.show', $task) }}" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition shadow-sm w-full sm:w-auto text-center">👁 Просмотр</a>
            <a href="{{ route('tasks.edit', $task) }}" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 transition shadow-sm w-full sm:w-auto text-center">✏ Редактировать</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition shadow-sm w-full sm:w-auto text-center">🗑 Удалить</button>
            </form>
        </div>

        <div class="flex items-center gap-2 mt-4 flex-wrap">
            @if($task->status == 'not taken')
                <form action="{{ route('tasks.take', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 shadow-sm transition w-full sm:w-auto text-center">🤝 Взяться за задачу</button>
                </form>
            @elseif($task->status == 'in process')
                <form action="{{ route('tasks.drop', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 shadow-sm transition w-full sm:w-auto text-center">🚫 Бросить задачу</button>
                </form>
                <form action="{{ route('tasks.finish', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 shadow-sm transition w-full sm:w-auto text-center">✅ Завершить задачу</button>
                </form>
            @endif
        </div>
    </div>
</div>
