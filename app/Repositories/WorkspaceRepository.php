<?php

    namespace App\Repositories;

    use Prettus\Repository\Contracts\RepositoryInterface;

    interface WorkspaceRepository extends RepositoryInterface
    {
        public function checkWorkspaceById($id);
    }
