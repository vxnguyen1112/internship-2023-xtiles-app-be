<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BlockRepository extends RepositoryInterface
{
    public function checkBlockId($id);

    public  function getBlockByPage($pageId);
}
