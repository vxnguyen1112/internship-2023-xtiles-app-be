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

    public function getCommentByDocument($document_id)
    {
        $result = $this->commentService->getCommentByDocument($document_id);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result);
    }

    public function getCommentByContent(Request $request)
    {
        $result = $this->commentService->getCommentByContent($request['contentId']);
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

    public function update(StoreCommentRequest $request)
    {
        $result = $this->commentService->update($request->all(),$request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
    }

    public function delete(Request $request)
    {
        $result = $this->commentService->delete($request['id']);
        if (is_null($result)) {
            return CommonResponse::notFoundResponse();
        }
        return CommonResponse::deleteSuccessfullyResponse();
    }
}
