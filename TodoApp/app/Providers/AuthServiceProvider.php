<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Policies\CategoryPolicy;
use App\Policies\TagPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        Tag::class => TagPolicy::class,
        Category::class => CategoryPolicy::class
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}
