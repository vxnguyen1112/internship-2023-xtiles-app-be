<?php

namespace App\Services;

use App\Helpers\HttpCode;
use App\Models\Block;
use App\Repositories\BlockRepository;
use Illuminate\Support\Facades\Log;

class BlockService
{
    protected $blockRepository;

    /**
     * @param $blockRepository
     */


    public function __construct(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }


    public function index()
    {
        return $this->blockRepository->all();
    }

    public function store($data)
    {
        return $this->blockRepository->create($data);
    }

    public function update($data, $id)
    {
        $isExist = $this->blockRepository->checkBlockById($id);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->update($data, $id);
    }

    public function delete($id)
    {
        $isExist = $this->blockRepository->checkBlockById($id);
        if (!$isExist) {
            return;
        }
        return $this->blockRepository->delete($id);
    }
}
