<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-6 text-blue-900">Теги</h1>

            <div class="mb-4 text-right">
                <a href="{{ route('tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 shadow-sm">
                    ➕ Добавить тег
                </a>
            </div>
        </div>

        <div class="bg-blue-50 border-2 border-blue-200 shadow-md rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($tags as $tag)
                <div class="relative bg-blue-100 border border-blue-300 rounded-lg p-4 shadow-sm">
                    <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-blue-200 border border-blue-300 shadow-md"></div>
                    <h2 class="text-lg font-semibold text-blue-900 mb-2">
                        📎 {{ $tag->name }}
                    </h2>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('tasks.index') }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 shadow-sm">👁 Просмотр</a>
                        <a href="{{ route('tags.update', $tag) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 shadow-sm">✏ Редактировать</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Точно удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 shadow-sm">🗑 Удалить</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-blue-800">Тегов пока нет.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
