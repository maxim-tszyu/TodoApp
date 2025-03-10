<div class="flex gap-2 flex-wrap mb-2">
    @foreach ($tags as $tag)
        <span class="bg-yellow-200 text-yellow-900 px-2 py-1 rounded-full text-sm shadow-sm hover:bg-yellow-300 transition">
            #{{ $tag->name }}
        </span>
    @endforeach
</div>
