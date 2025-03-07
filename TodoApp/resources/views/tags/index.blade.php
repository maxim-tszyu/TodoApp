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
                <x-tags.card :$tag />
            @empty
                <p class="text-blue-800">Тегов пока нет.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
