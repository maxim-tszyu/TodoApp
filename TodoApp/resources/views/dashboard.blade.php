<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold mb-6 text-[#5d5c61]">Главная</h1>
        </div>

        <div class="grid grid-cols-8 gap-4">
            <div class="col-span-5 space-y-4">
                <div class="bg-[#7395ae] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Статистика задач</h2>
                    <div class="flex justify-between">
                        <div class="text-center">
                            <p>Создано</p>
                            <p class="text-2xl">{{ $tasks_created ?? '' }}</p>
                        </div>
                        <div class="text-center">
                            <p>Завершено</p>
                            <p class="text-2xl">{{ $tasks_finished ?? ''}}</p>
                        </div>
                        <div class="text-center">
                            <p>Брошено</p>
                            <p class="text-2xl">{{ $tasks_abandoned ?? ''}}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#b1a296] p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Наблюдения</h2>
                    <p>Больше всего задач вы создаёте в {{ $day_most_created ?? ''}}.</p>
                    <p>Больше всего задач вы завершаете во {{ $day_most_finished ?? ''}}</p>
                </div>

                <div class="bg-[#379683] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Факт дня</h2>
                    <p>Человек, который просыпается в 6 утра, по статистике, закрывает все задачи к 18:00 вечера.</p>
                </div>

                <div class="bg-[#f0f0f0] p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Теги</h2>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Работа</span>
                            <span>(5)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Дом</span>
                            <span>(3)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Здоровье</span>
                            <span>(8)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Образование</span>
                            <span>(2)</span>
                        </li>
                    </ul>
                </div>

                <!-- Список категорий -->
                <div class="bg-[#f0f0f0] p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Категории</h2>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Низкая важность</span>
                            <span>(12)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Средняя важность</span>
                            <span>(8)</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Высокая важность</span>
                            <span>(5)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Правый блок (уже меньше) -->
            <div class="col-span-3 space-y-4">
                <div class="bg-[#557a95] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Активные задачи</h2>
                    <ul class="space-y-2">
                        <li>Приготовить вкусный ужин</li>
                        <li>Устранить засор в раковине</li>
                        <li>Стирать белого белья</li>
                        <li>Разморозить холодильник</li>
                    </ul>
                </div>

                <div class="bg-[#5d5c61] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">График успеваемости</h2>
                    <div class="h-40 bg-white rounded-lg">График тут</div>
                </div>

                <!-- Блок с каруселью низкой важности -->
                <div class="bg-[#d9d9d9] p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Низкая важность</h2>
                    <div class="flex space-x-4 overflow-x-auto">
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Почистить обувь</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Полить цветы</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Помыть машину</p>
                        </div>
                    </div>
                </div>

                <!-- Блок с каруселью средней важности -->
                <div class="bg-[#f8b400] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Средняя важность</h2>
                    <div class="flex space-x-4 overflow-x-auto">
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Завершить отчет</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Позвонить клиенту</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Отправить письмо</p>
                        </div>
                    </div>
                </div>

                <!-- Блок с каруселью высокой важности -->
                <div class="bg-[#f44336] text-white p-4 rounded-lg shadow">
                    <h2 class="font-bold mb-2">Высокая важность</h2>
                    <div class="flex space-x-4 overflow-x-auto">
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Завершить проект</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Провести встречу с инвесторами</p>
                        </div>
                        <div class="flex-none w-48 bg-white p-4 rounded-lg shadow">
                            <p>Подготовить презентацию</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
