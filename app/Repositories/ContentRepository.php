<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ContentRepository extends RepositoryInterface
{
    public function checkContentId($id);

    public function getContentByBlock($blockId);
}
