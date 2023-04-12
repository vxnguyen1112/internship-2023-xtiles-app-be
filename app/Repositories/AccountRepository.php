<?php

    namespace App\Repositories;


    use Prettus\Repository\Contracts\RepositoryInterface;

    interface AccountRepository extends RepositoryInterface
    {
        public function getAllFavouriteOfAccount($id);

        public function getAllDocumentShareOfAccount($id);
    }
