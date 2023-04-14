<?php

namespace App\Repositories\Eloquent;

use App\Models\Block;
use App\Models\Content;
use App\Repositories\ContentRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


class ContentRepositoryEloquent extends BaseRepository implements ContentRepository
{

    public function model()
    {
        return Content::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function checkContentId($id)
    {
        return Content::where("id", $id)->exists();
    }

    public function getContentByBlock($blockId)
    {
        return Content::where('block_id', $blockId)->oldest()->get();
    }
}
