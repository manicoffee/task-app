<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Services\TaskRepositoryInterface;
use App\Infrastructure\Repositories\EloquentTaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
