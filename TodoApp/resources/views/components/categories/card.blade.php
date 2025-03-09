@props(['category'])
<div class="relative bg-green-100 border border-green-300 rounded-lg p-4 shadow-sm">
    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-green-200 border border-green-300 shadow-md"></div>
    <h2 class="text-lg font-semibold text-green-900 mb-2">
        🏷 {{ $category->name }}
    </h2>
    <div class="flex items-center gap-2">
        <a href="{{ route('categories.show', $category) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 shadow-sm">👁 Просмотр</a>
        <a href="{{ route('categories.edit', $category) }}" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 shadow-sm">✏ Редактировать</a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 shadow-sm">🗑 Удалить</button>
        </form>
    </div>
</div>
