<?php

namespace App\Providers;

use App\Interface\Auth\AuthInterface;
use App\Interface\Task\TaskInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Task\TaskRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
