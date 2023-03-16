<?php

namespace App\Services;

use App\Helpers\HttpCode;
use App\Models\Block;
use App\Repositories\BlockRepository;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\Log;

class BlockService
{
    protected $blockRepository;
    protected $pageRepository;

    /**
     * @param $blockRepository
     */


    public function __construct(BlockRepository $blockRepository, PageRepository $pageRepository)
    {
        $this->blockRepository = $blockRepository;
        $this->pageRepository = $pageRepository;
    }


    public function getBlockByPage($pageId)
    {
        $isExist = $this->pageRepository->checkPageById($pageId);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->getBlockByPage($pageId);
    }

    public function getBlockById($id)
    {
        $isExist = $this->blockRepository->checkBlockId($id);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->find($id);
    }

    public function store($data)
    {
        return $this->blockRepository->create($data);
    }

    public function update($data, $id)
    {
        $isExist = $this->blockRepository->checkBlockId($id);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->update($data, $id);
    }

    public function delete($id)
    {
        $isExist = $this->blockRepository->checkBlockId($id);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->delete($id);
    }
}
