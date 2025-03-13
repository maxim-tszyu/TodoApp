<?php

namespace App\Providers;

use App\Events\TaskRemindedEvent;
use App\Listeners\MakeTaskRemindJob;
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
