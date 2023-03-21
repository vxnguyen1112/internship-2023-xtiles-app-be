<?php

namespace App\Services;

use App\Helpers\HttpCode;
use App\Models\Content;
use App\Repositories\BlockRepository;
use App\Repositories\ContentRepository;
use Illuminate\Support\Facades\Log;


class ContentService
{
    protected $contentRepository, $blockRepository;

    /**
     * @param $contentRepository
     */


    public function __construct(ContentRepository $contentRepository, BlockRepository $blockRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->blockRepository = $blockRepository;
    }


    public function getContentByBlock($blockId)
    {
        $isExist = $this->blockRepository->checkBlockById($blockId);
        if (!$isExist) {
            return;
        }
        return $this->contentRepository->getContentByBlock($blockId);
    }

    public function getContentById($id)
    {
        $isExist = $this->contentRepository->checkContentId($id);
        if (!$isExist) {
            return;
        }
        return $this->contentRepository->find($id);
    }

    public function store($data)
    {
        return $this->contentRepository->create($data);
    }

    public function update($data, $id)
    {
        $isExist = $this->contentRepository->checkContentId($id);
        if (!$isExist) {
            return;
        }
        return $this->contentRepository->update($data, $id);
    }

    public function delete($id)
    {
        $isExist = $this->contentRepository->checkContentId($id);
        if (!$isExist) {
            return;
        }
        return $this->contentRepository->delete($id);
    }
}
