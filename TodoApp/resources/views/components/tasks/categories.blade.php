<div class="flex gap-2 flex-wrap mb-2">
    @foreach ($categories as $category)
        <span class="bg-blue-200 text-blue-900 px-2 py-1 rounded-full text-sm">
            {{ $category->name }}
        </span>
    @endforeach
</div>
