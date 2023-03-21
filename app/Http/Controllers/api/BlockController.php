<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreBlockRequest;
    use App\Services\BlockService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class BlockController extends Controller
    {
        protected $blockService;

        public function __construct(BlockService $blockService)
        {
            $this->blockService = $blockService;
        }

        public function getBlockByPage(Request $request)
        {
            $result = $this->blockService->getBlockByPage($request['pageId']);
            if (is_null($result)) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result);
        }

        public function getBlockById(Request $request)
        {
            $result = $this->blockService->getBlockById($request['id']);
            if (is_null($result)) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result);
        }

        public function store(StoreBlockRequest $request)
        {
            $result = $this->blockService->store($request->all());
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function update(Request $request)
        {
            $result = $this->blockService->update($request->all(), $request['id']);
            if (is_null($result)) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function delete(Request $request)
        {
            $result = $this->blockService->delete($request['id']);
            if (is_null($result)) {
                return CommonResponse::notFoundResponse();
            }
            return CommonResponse::deleteSuccessfullyResponse();
        }
    }
