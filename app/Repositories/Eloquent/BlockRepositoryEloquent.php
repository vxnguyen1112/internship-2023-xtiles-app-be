<?php

namespace App\Repositories\Eloquent;

use App\Models\Block;
use App\Models\Page;
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

    public function checkBlockId($id)
    {
        return Block::where("id", $id)->exists();
    }

    public function getBlockByPage($pageId)
    {
        return Block::where('page_id', $pageId)->get();
    }
}
