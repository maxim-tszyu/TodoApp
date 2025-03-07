<x-app-layout>
    <x-categories.category-layout>
        <x-categories.title>Create a new Category!</x-categories.title>
        <x-forms.form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            <x-forms.input name="title" label="Title" placeholder="Title"></x-forms.input>
        </x-forms.form>
    </x-categories.category-layout>

</x-app-layout>
