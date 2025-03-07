<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-6 text-yellow-900">Задачи</h1>

            <div class="mb-4 text-right">
                <a href="{{ route('tasks.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow-sm">
                    ➕ Добавить задачу
                </a>
            </div>
        </div>

        <div class="bg-yellow-50 border-2 border-yellow-200 shadow-md rounded-lg p-6">
            <div class="flex flex-wrap gap-4 justify-between">
                @forelse ($tasks as $task)
                    <x-tasks.card :task="$task" />
                @empty
                    <p class="text-yellow-800">Задач пока нет.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
