<?php

namespace App\Providers;

use App\Events\InactiveTasksDeleteEvent;
use App\Events\MapEventAsFailedEvent;
use App\Events\TaskRemindedEvent;
use App\Events\TaskUnnoticedEvent;
use App\Listeners\MakeTaskRemindJob;
use App\Listeners\MapTaskAsFailedListener;
use App\Listeners\NotifyFailedTaskListener;
use App\Listeners\TaskUnnoticedListener;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        TaskRemindedEvent::class => [
            MakeTaskRemindJob::class,
        ],
        InactiveTasksDeleteEvent::class => [
            \App\Listeners\InactiveTasksDelete::class,
        ],
        MapEventAsFailedEvent::class => [
            MapTaskAsFailedListener::class,
            NotifyFailedTaskListener::class,
        ],
        TaskUnnoticedEvent::class => [
            TaskUnnoticedListener::class,
        ]

    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
