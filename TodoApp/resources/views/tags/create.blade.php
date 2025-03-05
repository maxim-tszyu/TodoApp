<x-app-layout>
    <x-tags.tag-layout>
        <x-tags.title>Create a new Tag!</x-tags.title>
        <x-forms.form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
            <x-forms.input name="title" label="Title" placeholder="Title"></x-forms.input>
        </x-forms.form>
    </x-tags.tag-layout>

</x-app-layout>
