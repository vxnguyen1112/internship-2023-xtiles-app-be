<?php

namespace App\Http\Controllers\api;

use App\Helpers\CommonResponse;
use App\Helpers\HttpCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\BlockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlockController extends Controller
{
    protected $blockService;

    public function __construct(BlockService $blockService)
    {
        $this->middleware('auth:api');
        $this->blockService = $blockService;
    }

    public function index()
    {
        $result = $this->blockService->index();
        return ResponseHelper::send($result);
    }

    public function store(Request $request)
    {
        $result = $this->blockService->store($request->all());
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function update(Request $request, $id)
    {
        $result = $this->blockService->update($request->all(), $id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function delete($id)
    {
        $result = $this->blockService->delete($id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }
}
