@props(['label', 'name', 'type' => 'date'])

@php
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'value' => old($name),
        'class' => 'w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500'
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes->merge($defaults) }}>
</x-forms.field>
