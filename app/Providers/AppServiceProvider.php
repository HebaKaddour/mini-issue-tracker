<?php

namespace App\Providers;

use GuzzleHttp\Promise\Is;
use App\Services\IssueService;
use App\Repositories\issueRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IssueInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IssueService::class, function ($app) {
            return new IssueService($app->make(IssueRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
