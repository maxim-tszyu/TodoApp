<form {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif
    {{ $slot }}

    <div class="flex justify-end">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 shadow-sm transition duration-200">
            🚀 Отправить
        </button>
    </div>
</form>
