<x-app-layout>
    <x-tasks.task-layout>
        <x-tasks.title>Создать новую задачу!</x-tasks.title>
        <x-forms.form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">

            <x-forms.input name="title" label="Заголовок" placeholder="Введите заголовок задачи" class="mb-4"/>

            <x-forms.input name="body" label="Описание" placeholder="Введите описание задачи" class="mb-4"/>

            <x-forms.select name="priority" label="Приоритет"
                            :options="['low' => 'Низкий', 'medium' => 'Средний', 'high' => 'Высокий']" class="mb-4"/>

            <x-forms.datetime name="deadline" label="Дедлайн" type="datetime-local" class="mb-4"/>

            <x-forms.select name="categories[]" label="Категории" :options="$categories->pluck('name', 'id')->toArray()"
                            multiple class="mb-4"/>

            <x-forms.select name="tags[]" label="Тэги" :options="$tags->pluck('name', 'id')->toArray()" multiple class="mb-4"/>

            <x-forms.file name="path" label="Прикрепить документы" class="mb-4"/>

        </x-forms.form>
    </x-tasks.task-layout>
</x-app-layout>
