<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BlockRepository extends RepositoryInterface
{
    public function checkBlockById($id);
}
