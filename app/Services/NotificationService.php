<?php

    namespace App\Services;


    use App\Repositories\NotificationReponsitory;

    class NotificationService
    {
        protected $notificationRepository;

        /**
         * @param $notificationRepository
         */
        public function __construct(NotificationReponsitory $notificationRepository)
        {
            $this->notificationRepository = $notificationRepository;
        }

        public function store($data)
        {
            return $this->notificationRepository->create($data);
        }

        public function getNotification()
        {
            return $this->notificationRepository->getNotification();
        }

        public function checkNotification()
        {
            $check = $this->notificationRepository->checkNotification();
            return ["check" => $check];
        }

    }
