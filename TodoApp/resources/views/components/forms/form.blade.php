<form {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif
    {{ $slot }}

    <div class="flex justify-end">
    </div>
</form>
