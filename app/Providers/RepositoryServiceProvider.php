<?php

    namespace App\Providers;

    use App\Repositories\BlockRepository;
    use App\Repositories\ContentRepository;
    use App\Repositories\Eloquent\BlockRepositoryEloquent;
    use App\Repositories\CommentRepository;
    use App\Repositories\Eloquent\CommentRepositoryEloquent;
    use App\Repositories\Eloquent\ContentRepositoryEloquent;
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
            $this->app->bind(
                \App\Repositories\PageRepository::class,
                \App\Repositories\Eloquent\PageRepositoryEloquent::class
            );

            $this->app->bind(
                ContentRepository::class,
                ContentRepositoryEloquent::class
            );

            $this->app->bind(
                CommentRepository::class,
                CommentRepositoryEloquent::class
            );
            $this->app->bind(
                \App\Repositories\WorkspaceRepository::class,
                \App\Repositories\Eloquent\WorkspaceRepositoryEloquent::class
            );
            $this->app->bind(\App\Repositories\ShareDocumentRepository::class,
                \App\Repositories\Eloquent\ShareDocumentRepositoryEloquent::class);
        }
    }
