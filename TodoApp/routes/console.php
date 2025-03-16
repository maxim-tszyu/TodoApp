<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Task;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::call(function() {
    Task::whereDate('deadline', '=', date('Y-m-d', strtotime('tomorrow')))->each(function($task) {
        event(new \App\Events\TaskRemindedEvent($task));
    });
})->dailyAt('00:00')->name('task_reminder');
Schedule::call(function() {
    Task::whereDate('updated_at', '=', date('Y-m-d', strtotime('previous year')))->each(function($task) {
        event(new \App\Events\InactiveTasksDeleteEvent($task));
    });
})->dailyAt('00:00')->name('old_tasks_delete');

