<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-blue-900">Редактировать тег</h1>

        <div class="bg-blue-50 border-2 border-blue-200 shadow-md rounded-lg p-6">
            <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="block text-blue-800 mb-2">Название</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $tag->name) }}"
                           class="w-full border border-blue-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500"
                           required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('tags.index') }}" class="text-blue-600 hover:underline">
                        Назад к тегам
                    </a>

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 shadow-sm">
                        💾 Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
