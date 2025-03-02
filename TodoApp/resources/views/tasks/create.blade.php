<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-forms.form method="POST" action="/" enctype="multipart/form-data">
                        <x-forms.input name="title" label="Title" placeholder="Title"></x-forms.input>
                        <x-forms.input name="body" label="Body" placeholder="Body"></x-forms.input>
                        <x-forms.select name="status" label="Status" :options="['in process' => 'In process', 'finished' => 'Finished', 'abandoned' => 'Abandoned']" />
                        <x-forms.select name="priority" label="Priority" :options="['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']" />
                        <x-forms.datetime name="deadline" label="Deadline" type="datetime-local" />
                        <x-forms.select name="categories" label="Categories" :options="$tags->pluck('name','id')->toArray()" />
                        <x-forms.select name="tags" label="Tags" :options="$tags->pluck('name','id')->toArray()" />
                        <x-forms.file name="path" label="Attached documents" />
                    </x-forms.form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
