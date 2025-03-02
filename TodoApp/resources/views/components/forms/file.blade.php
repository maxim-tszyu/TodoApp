@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'file',
        'id' => $name,
        'name' => $name,
        'class' => 'w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500'
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes->merge($defaults) }}>
</x-forms.field>
