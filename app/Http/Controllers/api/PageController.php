<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StorePageRequest;
    use App\Models\Page;
    use App\Services\PageService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class PageController extends Controller
    {
        protected $pageService;

        public function __construct(PageService $pageService)
        {
            $this->pageService = $pageService;
        }

        public function getPageById($id)
        {
            return ResponseHelper::send($this->pageService->getPageById($id), statusCode: HttpCode::OK);
        }

        public function getPageByQuery(Request $request)
        {
            $query = $request->only(['name', 'document_id']);
            return ResponseHelper::send($this->pageService->getPageByQuery($query), statusCode: HttpCode::OK);
        }

        public function store(StorePageRequest $request)
        {
            $result = $this->pageService->store($request->all());
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function update(Request $request, $id)
        {
            $result = $this->pageService->update($request->except('document_id'), $id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result, statusCode: HttpCode::OK);
        }

        public function destroy($id)
        {
            $result = $this->pageService->delete($id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return CommonResponse::deleteSuccessfullyResponse();
        }
    }
