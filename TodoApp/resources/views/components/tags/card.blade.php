@props(['tag'])
<div class="relative bg-blue-100 border border-blue-300 rounded-lg p-4 shadow-sm">
    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-blue-200 border border-blue-300 shadow-md"></div>
    <h2 class="text-lg font-semibold text-blue-900 mb-2">
        📎 {{ $tag->name }}
    </h2>
    <div class="flex items-center gap-2">
        <a href="{{ route('tasks.index') }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 shadow-sm">👁 Просмотр</a>
        <a href="{{ route('tags.edit', $tag) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 shadow-sm">✏ Редактировать</a>
        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 shadow-sm">🗑 Удалить</button>
        </form>
    </div>
</div>
