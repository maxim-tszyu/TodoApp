<x-app-layout>
    <x-tasks.task-layout>
        <x-tasks.title>Create a new Task!</x-tasks.title>
        <x-forms.form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
            <x-forms.input name="title" label="Title" placeholder="Title"></x-forms.input>
            <x-forms.input name="body" label="Body" placeholder="Body"></x-forms.input>
            <x-forms.select name="priority" label="Priority"
                            :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']"/>
            <x-forms.datetime name="deadline" label="Deadline" type="datetime-local"/>
            <x-forms.select name="categories[]" label="Categories" :options="$categories->pluck('name','id')->toArray()"
                            multiple/>
            <x-forms.select name="tags[]" label="Tags" :options="$tags->pluck('name','id')->toArray()" multiple/>
            <x-forms.file name="path" label="Attached documents"/>
        </x-forms.form>
    </x-tasks.task-layout>

</x-app-layout>
