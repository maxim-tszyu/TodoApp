@props(['name', 'label'])
<div class="inline-flex items-center gap-x-2">
    <span class="w-2 h-2 bg-white inline-block"></span>
    <label class="text-xl text-yellow-900" for="{{ $name }}">{{ $label }}</label>
</div>
