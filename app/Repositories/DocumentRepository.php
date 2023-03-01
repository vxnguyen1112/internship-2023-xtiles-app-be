<?php

    namespace App\Repositories;

    use Prettus\Repository\Contracts\RepositoryInterface;

    interface DocumentRepository extends RepositoryInterface
    {
        public function checkDocumentById($id);
        public function getDocumentPersonal($idAccount);
    }
