<?php

namespace App\Providers;

use App\Repositories\BlockRepository;
use App\Repositories\Eloquent\BlockRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->app->bind(
            \App\Repositories\AccountRepository::class,
            \App\Repositories\Eloquent\AccountRepositoryEloquent::class
        );
        $this->app->bind(
            BlockRepository::class,
            BlockRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\DocumentRepository::class,
            \App\Repositories\Eloquent\DocumentRepositoryEloquent::class
        );
    }
}
