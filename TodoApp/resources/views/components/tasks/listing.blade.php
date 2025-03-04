@props(['field', 'title'])
<div class="mb-4">
    <h2 class="text-xl font-semibold mb-2 text-yellow-900">{{$title}}</h2>
    <div class="flex flex-wrap gap-2">
        @foreach($field as $subfield)
            <span class="bg-yellow-200 text-yellow-900 text-sm font-medium px-2.5 py-0.5 rounded shadow-sm">
                        {{ $subfield->name }}
                    </span>
        @endforeach
    </div>
</div>
