<?php

namespace App\Http\Controllers\api;

use App\Helpers\CommonResponse;
use App\Helpers\HttpCode;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getCommentById($id)
    {
        $result = $this->commentService->getCommentById($id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function getCommentByDocument($documentId)
    {
        $result = $this->commentService->getCommentByDocument($documentId);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function getCommentByContent($contentId)
    {
        $result = $this->commentService->getCommentByContent($contentId);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function store(StoreCommentRequest $request)
    {
        $result = $this->commentService->store($request->all());
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function update(StoreCommentRequest $request, $id)
    {
        $result = $this->commentService->update($request->all(), $id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function delete($id)
    {
        $result = $this->commentService->delete($id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return CommonResponse::deleteSuccessfullyResponse();
    }
}
