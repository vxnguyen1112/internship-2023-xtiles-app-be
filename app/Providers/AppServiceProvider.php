<?php

    namespace App\Providers;

    use App\Models\Document_account;
    use App\Observers\ShareDocumentObserver;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register()
        {
            $this->app->register(RepositoryServiceProvider::class);
        }

        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            Document_account::observe(ShareDocumentObserver::class);
        }
    }
