<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-6 text-green-900">Категории</h1>

            <div class="mb-4 text-right">
                <a href="{{ route('categories.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 shadow-sm">
                    ➕ Добавить категорию
                </a>
            </div>
        </div>

        <div class="bg-green-50 border-2 border-green-200 shadow-md rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($categories as $category)
                <x-categories.card :$category />
            @empty
                <p class="text-green-800">Категорий пока нет.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
