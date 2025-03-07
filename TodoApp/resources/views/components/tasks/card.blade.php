@props(['task'])
<div class="mb-6 w-full sm:w-1/2 lg:w-1/3 px-4">
    <div class="bg-white border-2 border-yellow-200 rounded-lg p-4 shadow-md">
        <h2 class="text-xl font-semibold text-yellow-900 mb-1">
            <a href="{{ route('tasks.show', $task) }}" class="hover:underline">{{ $task->title }}</a>
        </h2>
        <p class="text-yellow-800 mb-1">Автор: {{ $task->user->name }}</p>
        <p class="text-yellow-800 mb-1">Дедлайн: {{ $task->deadline->format('d.m.Y H:i') }}</p>

        <p class="text-yellow-800 mb-1">
            Категории:
            <span class="text-blue-700 font-semibold">
                @if($task->categories->isNotEmpty())
                    @foreach($task->categories as $category)
                        {{ $category->name }}
                    @endforeach
                @else
                    Без категории
                @endif
            </span>
        </p>

        <div class="mb-2">
            @if($task->tags->isNotEmpty())
                <p class="text-yellow-800 mb-1">Теги:</p>
                <div class="flex gap-2 flex-wrap">
                    @foreach ($task->tags as $tag)
                        <span class="bg-yellow-200 text-yellow-900 px-2 py-1 rounded-full text-sm">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-yellow-800 mb-1">Теги: <span class="text-gray-500">Отсутствуют</span></p>
            @endif
        </div>

        <div class="flex items-center gap-2 mt-2">
            <a href="{{ route('tasks.show', $task) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 shadow-sm">👁 Просмотр</a>
            <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 shadow-sm">✏ Редактировать</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 shadow-sm">🗑 Удалить</button>
            </form>
        </div>

        <div class="flex items-center gap-2 mt-2">
            @if($task->status == 'not taken')
                <form action="{{ route('tasks.take', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 shadow-sm">🤝 Взяться за задачу</button>
                </form>
            @elseif($task->status == 'in process')
                <form action="{{ route('tasks.drop', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-orange-500 text-white px-2 py-1 rounded hover:bg-orange-600 shadow-sm">🚫 Бросить задачу</button>
                </form>
                <form action="{{ route('tasks.finish', $task) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 shadow-sm">✅ Завершить задачу</button>
                </form>
            @endif
        </div>
    </div>
</div>
