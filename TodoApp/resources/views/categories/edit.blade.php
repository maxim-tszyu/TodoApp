<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-green-900">Редактировать категорию</h1>

        <div class="bg-green-50 border-2 border-green-200 shadow-md rounded-lg p-6">
            <form action="{{ route('categories.update', $cat->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="block text-green-800 mb-2">Название</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $cat->name) }}"
                           class="w-full border border-green-300 rounded px-4 py-2 focus:outline-none focus:border-green-500"
                           required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('categories.index') }}"
                       class="text-green-600 hover:underline">Назад к категориям</a>

                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 shadow-sm">
                        💾 Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
