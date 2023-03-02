<?php

namespace App\Repositories\Eloquent;

use App\Models\Block;
use App\Repositories\BlockRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


class BlockRepositoryEloquent extends BaseRepository implements BlockRepository
{

    public function model()
    {
        return Block::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function checkBlockById($id)
    {
        return Block::where("id", $id)->exists();
    }
}
