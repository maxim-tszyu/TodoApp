@props(['label', 'name', 'options' => []])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500'
    ];
@endphp

<x-forms.field :$label :$name>
    <select {{ $attributes->merge($defaults) }}>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected(old($name) == $value)>{{ $text }}</option>
        @endforeach
    </select>
</x-forms.field>
