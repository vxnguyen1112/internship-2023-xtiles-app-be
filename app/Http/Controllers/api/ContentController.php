<?php

namespace App\Http\Controllers\api;

use App\Helpers\CommonResponse;
use App\Helpers\HttpCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentRequest;
use App\Services\ContentService;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function getContentByBlock(Request $request)
    {
        $result = $this->contentService->getContentByBlock($request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function getContentById(Request $request)
    {
        $result = $this->contentService->getContentById($request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function store(StoreContentRequest $request)
    {
        $result = $this->contentService->store($request->all());
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function update(Request $request)
    {
        $result = $this->contentService->update($request->all(), $request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function delete(Request $request)
    {
        $result = $this->contentService->delete($request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return CommonResponse::deleteSuccessfullyResponse();
    }
}
