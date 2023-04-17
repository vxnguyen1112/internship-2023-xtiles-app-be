<?php

    namespace App\Repositories;

    use Prettus\Repository\Contracts\RepositoryInterface;

    interface NotificationReponsitory extends RepositoryInterface
    {
        public function getNotification();

        public function checkNotification();
    }
